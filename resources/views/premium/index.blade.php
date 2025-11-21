<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upgrade to Premium') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Pricing Card -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <div class="text-center mb-8">
                        <h3 class="text-3xl font-bold text-gray-900 mb-2">StudyTube Premium</h3>
                        <p class="text-gray-600">Unlock advanced features and take your learning to the next level</p>
                    </div>

                    <div class="border-t border-b border-gray-200 py-8 mb-8">
                        <div class="text-center mb-6">
                            <span class="text-5xl font-bold text-gray-900">$9.99</span>
                            <span class="text-gray-600">/month</span>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 max-w-2xl mx-auto">
                            <!-- Free Features -->
                            <div class="space-y-3">
                                <h4 class="font-semibold text-gray-900 mb-4">Free Plan Includes:</h4>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Unlimited Topics</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Unlimited Notes</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Basic Support</span>
                                </div>
                            </div>

                            <!-- Premium Features -->
                            <div class="space-y-3 border-l-4 border-indigo-600 pl-6">
                                <h4 class="font-semibold text-indigo-600 mb-4">Premium Adds:</h4>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 text-indigo-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium">Priority Support</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 text-indigo-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium">Advanced Analytics</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 text-indigo-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium">Export Your Data</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 text-indigo-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
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
                           class="inline-flex items-center px-8 py-4 bg-indigo-600 border border-transparent rounded-lg font-semibold text-lg text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg hover:shadow-xl">
                            Subscribe Now
                        </a>
                        <p class="mt-4 text-sm text-gray-500">
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
