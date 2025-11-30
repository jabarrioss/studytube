<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
            {{ __('Upgrade to Premium') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Pricing Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full mb-4">
                            <span class="text-4xl">✨</span>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">StudyTube Premium</h3>
                        <p class="text-gray-600 dark:text-gray-400">Unlock advanced features and take your learning to the next level</p>
                    </div>

                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-xl p-8 mb-8 border border-indigo-200 dark:border-indigo-800">
                        <div class="text-center mb-8">
                            <div class="inline-flex items-baseline">
                                <span class="text-5xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">$9.99</span>
                                <span class="text-xl text-gray-600 dark:text-gray-400 ml-2">/month</span>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8 max-w-2xl mx-auto">
                            <!-- Free Features -->
                            <div class="space-y-4 bg-white dark:bg-gray-800 rounded-lg p-6 border border-gray-200 dark:border-gray-700">
                                <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                                    <span class="text-xl mr-2">🆓</span>
                                    Free Plan Includes:
                                </h4>
                                <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                                    <svg class="w-5 h-5 text-yellow-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Up to 5 Topics</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                                    <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Unlimited Notes</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                                    <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Basic Support</span>
                                </div>
                            </div>

                            <!-- Premium Features -->
                            <div class="space-y-4 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg p-6 text-white shadow-lg">
                                <h4 class="font-semibold mb-4 flex items-center">
                                    <span class="text-xl mr-2">✨</span>
                                    Premium Adds:
                                </h4>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium">Unlimited Topics</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium">No Ads</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium">Priority Support</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium">Advanced Analytics</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium">Export Your Data</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium">Early Access to New Features</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div class="text-center">
                        <a href="{{ $checkoutUrl }}" 
                           target="_blank"
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-semibold text-lg text-white hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition shadow-lg hover:shadow-xl">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Subscribe Now
                        </a>
                        <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                            Secure payment processed by Shopify
                        </p>
                    </div>
                </div>
            </div>

            <!-- FAQ or Additional Info -->
            <div class="mt-8 text-center text-sm text-gray-600">
                <p>Have questions? <a href="mailto:support@studytube.com" class="text-indigo-600 hover:text-indigo-800">Contact our support team</a></p>
            </div>
        </div>
    </div>
</x-app-layout>
