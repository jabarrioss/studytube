<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subscription Activated') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-8 text-center">
                    <!-- Success Icon -->
                    <div class="mb-6">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 dark:bg-green-900/30">
                            <svg class="h-10 w-10 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Success Message -->
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                        Welcome to Premium! 🎉
                    </h3>
                    
                    <p class="text-gray-600 dark:text-gray-400 mb-8">
                        Your subscription has been successfully activated. You now have access to all Premium features!
                    </p>

                    <!-- Premium Features -->
                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-lg p-6 mb-8 border border-indigo-200 dark:border-indigo-800">
                        <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-4">What You've Unlocked:</h4>
                        <ul class="space-y-3 text-left text-sm text-gray-700 dark:text-gray-300">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>Priority Email Support</strong> - Get help faster with dedicated support</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>Advanced Learning Analytics</strong> - Track your progress with detailed insights</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>Export Notes</strong> - Download your notes in PDF or Markdown format</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span><strong>Early Access</strong> - Be the first to try new features</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('topics.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg font-semibold hover:from-indigo-700 hover:to-purple-700 transition shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            Start Learning
                        </a>
                        
                        <a href="{{ route('subscription.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-50 dark:hover:bg-gray-600 transition shadow-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Manage Subscription
                        </a>
                    </div>

                    <!-- Support Info -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Need help getting started? Check out our 
                            <a href="{{ route('topics.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">learning guides</a>
                            or contact our 
                            <a href="mailto:support@studytube.com" class="text-indigo-600 dark:text-indigo-400 hover:underline">priority support team</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
