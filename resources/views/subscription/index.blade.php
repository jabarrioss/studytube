<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Premium Subscription') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Error Message -->
            @if (session('error'))
                <div class="mb-6 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Current Plan Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Current Plan</h3>
                            @if($subscription && $subscription->active())
                                <span class="bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 text-xs font-semibold px-3 py-1 rounded-full">
                                    Active
                                </span>
                            @else
                                <span class="bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 text-xs font-semibold px-3 py-1 rounded-full">
                                    Free
                                </span>
                            @endif
                        </div>

                        @if($subscription && $subscription->active())
                            <div class="space-y-3">
                                <div>
                                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                                        Premium
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                        $5.00 / month
                                    </p>
                                </div>

                                @if($subscription->onTrial())
                                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-3">
                                        <p class="text-sm text-blue-800 dark:text-blue-300">
                                            <strong>Trial ends:</strong> {{ $subscription->trial_ends_at->format('M d, Y') }}
                                        </p>
                                    </div>
                                @endif

                                @if($subscription->ends_at)
                                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-3">
                                        <p class="text-sm text-yellow-800 dark:text-yellow-300">
                                            <strong>Ends:</strong> {{ $subscription->ends_at->format('M d, Y') }}
                                        </p>
                                        <p class="text-xs text-yellow-700 dark:text-yellow-400 mt-1">
                                            Your subscription is cancelled but remains active until the end of the billing period.
                                        </p>
                                    </div>
                                @else
                                    <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3">
                                        <p class="text-sm text-gray-700 dark:text-gray-300">
                                            <strong>Status:</strong> Active and recurring
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="space-y-3">
                                <div>
                                    <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                                        Free
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-400 text-sm">
                                        $0.00 / month
                                    </p>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    You're currently on the free plan. Upgrade to Premium to unlock advanced features!
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Manage Subscription</h3>

                        @if($subscription && $subscription->active())
                            <div class="space-y-3">
                                @if($subscription->ends_at)
                                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 mb-3">
                                        <p class="text-sm text-yellow-800 dark:text-yellow-300">
                                            Your subscription is set to expire on {{ $subscription->ends_at->format('M d, Y') }}. You can resubscribe anytime after it expires.
                                        </p>
                                    </div>
                                @else
                                    <form method="POST" action="{{ route('subscription.cancel') }}" 
                                          onsubmit="return confirm('Are you sure you want to cancel your subscription? You will retain access until the end of your billing period.');">
                                        @csrf
                                        <button type="submit" class="w-full bg-red-600 dark:bg-red-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 dark:hover:bg-red-600 transition shadow-md">
                                            Cancel Subscription
                                        </button>
                                    </form>
                                @endif

                                <div class="pt-3 border-t border-gray-200 dark:border-gray-700">
                                    <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">Premium Features</h4>
                                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Priority email support
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Advanced learning analytics
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Export notes to PDF & Markdown
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Early access to new features
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @else
                            <div class="space-y-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Upgrade to Premium and unlock all features for just $5/month.
                                </p>

                                <form method="POST" action="{{ route('subscription.checkout') }}">
                                    @csrf
                                    <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transition shadow-md">
                                        Subscribe to Premium - $5/month
                                    </button>
                                </form>

                                <div class="pt-3 border-t border-gray-200 dark:border-gray-700">
                                    <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">What you'll get:</h4>
                                    <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Everything in Free, plus:
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Priority email support
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Advanced learning analytics
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Export notes to PDF & Markdown
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Early access to new features
                                        </li>
                                        <li class="flex items-start">
                                            <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Cancel anytime
                                        </li>
                                    </ul>
                                </div>

                                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                                    <p class="text-sm text-blue-800 dark:text-blue-300">
                                        💡 <strong>30-Day Money-Back Guarantee</strong><br>
                                        Try Premium risk-free. If you're not satisfied, request a full refund within 30 days.
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Billing History -->
            @if($subscription && $subscription->active())
                <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Billing History</h3>
                        
                        @php
                            $transactions = $user->transactions()->latest()->take(10)->get();
                        @endphp

                        @if($transactions->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Amount</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Invoice</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    {{ $transaction->created_at->format('M d, Y') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                    ${{ number_format($transaction->total / 100, 2) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300">
                                                        {{ ucfirst($transaction->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                    @if($transaction->invoice_url)
                                                        <a href="{{ $transaction->invoice_url }}" target="_blank" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                                                            Download
                                                        </a>
                                                    @else
                                                        <span class="text-gray-400 dark:text-gray-600">N/A</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-sm text-gray-600 dark:text-gray-400">No billing history available.</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.paddle.com/paddle/v2/paddle.js"></script>
        <script type="text/javascript">
            Paddle.Setup({ 
                token: '{{ config('cashier.client_side_token') }}',
                @if(config('cashier.sandbox'))
                    environment: 'sandbox'
                @endif
            });
        </script>
    @endpush
</x-app-layout>
