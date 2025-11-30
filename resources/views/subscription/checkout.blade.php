<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subscribe to Premium') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-8 text-center">
                    <div class="mb-6">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-gradient-to-br from-indigo-600 to-purple-600">
                            <span class="text-4xl">✨</span>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                        Complete Your Subscription
                    </h3>
                    
                    <p class="text-gray-600 dark:text-gray-400 mb-8">
                        Click the button below to complete your Premium subscription with Paddle.
                    </p>

                    @if(app()->environment('local'))
                        <div class="mb-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 text-left">
                            <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-2">⚙️ Debug Info (visible in local only)</h4>
                            <div class="text-sm text-blue-700 dark:text-blue-400 space-y-2">
                                @php
                                    $clientToken = config('cashier.client_side_token');
                                    $isSandboxToken = str_starts_with($clientToken, 'test_');
                                    $isProductionToken = str_starts_with($clientToken, 'live_');
                                    $tokenType = $isSandboxToken ? 'Sandbox (test_)' : ($isProductionToken ? 'Production (live_)' : 'Unknown');
                                @endphp
                                <p><strong>Client Token:</strong> <code class="bg-blue-100 dark:bg-blue-950 px-2 py-1 rounded">{{ $clientToken ? substr($clientToken, 0, 30) . '...' : '❌ NOT SET' }}</code></p>
                                <p><strong>Token Type:</strong> <code class="bg-blue-100 dark:bg-blue-950 px-2 py-1 rounded">{{ $clientToken ? $tokenType : '❌ NOT SET' }}</code></p>
                                <p><strong>Price ID:</strong> <code class="bg-blue-100 dark:bg-blue-950 px-2 py-1 rounded">{{ config('cashier.price_ids.premium') ?: '❌ NOT SET' }}</code></p>
                                <p><strong>Sandbox Mode (.env):</strong> <code class="bg-blue-100 dark:bg-blue-950 px-2 py-1 rounded">{{ config('cashier.sandbox') ? '✅ Yes' : '❌ No' }}</code></p>
                                <p><strong>Seller ID:</strong> <code class="bg-blue-100 dark:bg-blue-950 px-2 py-1 rounded">{{ config('cashier.seller_id') ?: '❌ NOT SET' }}</code></p>
                                
                                @if($clientToken && config('cashier.price_ids.premium'))
                                    @php
                                        $mismatch = ($isSandboxToken && !config('cashier.sandbox')) || ($isProductionToken && config('cashier.sandbox'));
                                    @endphp
                                    @if($mismatch)
                                        <div class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-300 dark:border-red-700 rounded">
                                            <p class="text-xs text-red-800 dark:text-red-300">
                                                <strong>❌ CONFIGURATION MISMATCH:</strong><br>
                                                Your token type ({{ $tokenType }}) doesn't match PADDLE_SANDBOX setting.<br>
                                                @if($isSandboxToken)
                                                    Set PADDLE_SANDBOX=true in your .env file.
                                                @else
                                                    Set PADDLE_SANDBOX=false in your .env file.
                                                @endif
                                            </p>
                                        </div>
                                    @endif
                                @endif
                                
                                <div class="mt-3 p-3 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-300 dark:border-yellow-700 rounded">
                                    <p class="text-xs text-yellow-800 dark:text-yellow-300">
                                        <strong>⚠️ 403 Error? Check this:</strong><br>
                                        1. Price ID <code>{{ config('cashier.price_ids.premium') }}</code> must exist in Paddle {{ $isSandboxToken ? 'SANDBOX' : 'PRODUCTION' }} environment<br>
                                        2. Go to your Paddle Dashboard → Catalog → Products<br>
                                        3. Verify the Price ID matches and is {{ $isSandboxToken ? 'in SANDBOX mode' : 'in PRODUCTION mode' }}<br>
                                        4. Make sure the price is active (not archived)
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <button 
                        onclick="openPaddleCheckout()"
                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transition shadow-lg">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Subscribe to Premium - $5/month
                    </button>

                    <p class="mt-6 text-sm text-gray-500 dark:text-gray-400">
                        Secure payment processed by Paddle • Cancel anytime
                    </p>

                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('subscription.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">
                            ← Back to Subscription
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.paddle.com/paddle/v2/paddle.js"></script>
        <script>
            // Initialize Paddle
            @if(config('cashier.client_side_token'))
                try {
                    Paddle.Setup({ 
                        token: '{{ config('cashier.client_side_token') }}'
                        @if(config('cashier.sandbox'))
                            , pwCustomer: undefined
                        @endif
                    });
                    console.log('Paddle initialized successfully');
                } catch (error) {
                    console.error('Paddle initialization error:', error);
                    alert('Failed to initialize Paddle. Please check configuration.');
                }
            @else
                console.error('Paddle client token is missing');
                alert('Paddle client token is not configured. Please set PADDLE_CLIENT_SIDE_TOKEN in your .env file.');
            @endif

            function openPaddleCheckout() {
                @if(config('cashier.client_side_token') && config('cashier.price_ids.premium'))
                    try {
                        console.log('Opening Paddle checkout...');
                        console.log('Price ID:', '{{ config('cashier.price_ids.premium') }}');
                        console.log('User email:', '{{ $user->email }}');
                        
                        Paddle.Checkout.open({
                            items: [{
                                priceId: '{{ config('cashier.price_ids.premium') }}',
                                quantity: 1
                            }],
                            customer: {
                                email: '{{ $user->email }}'
                            },
                            customData: {
                                user_id: '{{ $user->id }}'
                            },
                            settings: {
                                successUrl: '{{ route('subscription.success') }}'
                            }
                        });
                        
                        console.log('Checkout call completed');
                    } catch (error) {
                        console.error('Paddle checkout error:', error);
                        alert('Failed to open checkout: ' + error.message);
                    }
                @else
                    alert('Paddle is not fully configured. Please set PADDLE_CLIENT_SIDE_TOKEN and PADDLE_PREMIUM_PRICE_ID in your .env file.');
                @endif
            }
        </script>
    @endpush
</x-app-layout>
