<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'admin_users' => User::where('is_admin', true)->count(),
            'subscribed_users' => User::whereNotNull('plan_id')->count(),
            'total_plans' => Plan::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Display a listing of users
     */
    public function users()
    {
        $users = User::with('plan')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show detailed information about a specific user
     */
    public function showUser(User $user)
    {
        // Switch to user's tenant database to get their data
        $tenantDbPath = database_path("tenants/user_{$user->uuid}.sqlite");
        
        if (!file_exists($tenantDbPath)) {
            return redirect()->route('admin.users.index')
                ->with('error', 'User tenant database not found.');
        }

        Config::set('database.connections.tenant.database', $tenantDbPath);
        DB::reconnect('tenant');

        $topics = \App\Models\Tenant\Topic::on('tenant')
            ->withCount('notes')
            ->orderBy('created_at', 'desc')
            ->get();

        $notes = \App\Models\Tenant\Note::on('tenant')
            ->with('topic')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        $stats = [
            'total_topics' => $topics->count(),
            'completed_topics' => $topics->where('is_completed', true)->count(),
            'total_notes' => \App\Models\Tenant\Note::on('tenant')->count(),
            'learning_sessions' => \App\Models\Tenant\LearningSession::on('tenant')->count(),
        ];

        return view('admin.users.show', compact('user', 'topics', 'notes', 'stats'));
    }

    /**
     * Show the form for editing a user
     */
    public function editUser(User $user)
    {
        $plans = Plan::all();
        return view('admin.users.edit', compact('user', 'plans'));
    }

    /**
     * Update the specified user
     */
    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'is_admin' => 'required|boolean',
            'is_pana' => 'required|boolean',
            'plan_id' => 'nullable|exists:plans,id',
        ]);

        $user->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'User updated successfully.',
                'redirect' => route('admin.users.show', $user)
            ]);
        }

        return redirect()->route('admin.users.show', $user)
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage
     */
    public function destroyUser(User $user)
    {
        // Prevent self-deletion
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        // Delete tenant database file
        $tenantDbPath = database_path("tenants/user_{$user->uuid}.sqlite");
        if (file_exists($tenantDbPath)) {
            unlink($tenantDbPath);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User and their data deleted successfully.');
    }
}
