<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Display the subscription page.
     */
    public function index()
    {
        $user = Auth::user();
        $subscription = $user->subscription('default');
        
        // Get subscription details if active
        $subscriptionDetails = null;
        if ($subscription) {
            $subscriptionDetails = [
                'status' => $subscription->status,
                'paddle_id' => $subscription->paddle_id,
                'is_active' => $subscription->active(),
                'ends_at' => $subscription->ends_at,
                'paused_at' => $subscription->paused_at,
                'on_trial' => $subscription->onTrial(),
            ];
        }
        
        return view('subscription.index', [
            'user' => $user,
            'subscription' => $subscription,
            'subscriptionDetails' => $subscriptionDetails,
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
     * Handle Paddle webhooks.
     */
    public function webhook(Request $request)
    {
        // Paddle webhooks are automatically handled by Cashier
        return response('Webhook Handled', 200);
    }
}
