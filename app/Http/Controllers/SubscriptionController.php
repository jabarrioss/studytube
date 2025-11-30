<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display the subscription page.
     */
    public function index()
    {
        $user = auth()->user();
        
        return view('subscription.index', [
            'user' => $user,
            'subscription' => $user->subscription('default'),
        ]);
    }

    /**
     * Create a new subscription checkout session.
     */
    public function checkout(Request $request)
    {
        // Verify Paddle configuration
        if (empty(config('cashier.client_side_token')) || empty(config('cashier.price_ids.premium'))) {
            return redirect()->route('subscription.index')
                ->with('error', 'Paddle is not configured. Please contact support.');
        }

        return view('subscription.checkout', [
            'user' => $request->user()
        ]);
    }

    /**
     * Handle successful subscription.
     */
    public function success(Request $request)
    {
        return view('subscription.success');
    }

    /**
     * Cancel the subscription.
     */
    public function cancel(Request $request)
    {
        $request->user()->subscription('default')->cancel();

        return redirect()->route('subscription.index')
            ->with('success', 'Your subscription has been cancelled. You will retain access until the end of your billing period.');
    }

    /**
     * Resume the subscription.
     */
    public function resume(Request $request)
    {
        $request->user()->subscription('default')->resume();

        return redirect()->route('subscription.index')
            ->with('success', 'Your subscription has been resumed!');
    }

    /**
     * Handle Paddle webhooks.
     */
    public function webhook(Request $request)
    {
        // Paddle webhooks are automatically handled by Cashier
        return response('Webhook Handled', 200);
    }
}
