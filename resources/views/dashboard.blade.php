<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl shadow-xl p-8 mb-8 text-white">
                <h1 class="text-4xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h1>
                <p class="text-indigo-100 text-lg">Ready to continue your learning journey?</p>
            </div>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md hover:shadow-xl transition-shadow sm:rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-lg p-3">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"></path>
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Video Topics</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ Auth::user()->topics()->count() ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md hover:shadow-xl transition-shadow sm:rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg p-3">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Notes Taken</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">{{ Auth::user()->notes()->count() ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md hover:shadow-xl transition-shadow sm:rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-br from-amber-500 to-orange-500 rounded-lg p-3">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-5">
                                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Current Plan</p>
                                <p class="text-3xl font-bold text-gray-900 dark:text-gray-100">
                                    @if(Auth::user()->subscribed('premium'))
                                        <span class="text-2xl">Premium ✨</span>
                                    @else
                                        <span class="text-2xl">Free</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-xl mb-8 border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('topics.create') }}" class="flex items-center p-4 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 rounded-lg hover:from-indigo-100 hover:to-purple-100 dark:hover:from-indigo-900/30 dark:hover:to-purple-900/30 transition border border-indigo-200 dark:border-indigo-800">
                            <div class="flex-shrink-0 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900 dark:text-gray-100">Add New Video</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Start learning from a YouTube video</p>
                            </div>
                        </a>

                        <a href="{{ route('topics.index') }}" class="flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-lg hover:from-green-100 hover:to-emerald-100 dark:hover:from-green-900/30 dark:hover:to-emerald-900/30 transition border border-green-200 dark:border-green-800">
                            <div class="flex-shrink-0 bg-gradient-to-br from-green-600 to-emerald-600 rounded-lg p-3">
                                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900 dark:text-gray-100">View All Topics</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Browse your learning collection</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Getting Started Guide -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Getting Started with StudyTube</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-gradient-to-br from-indigo-600 to-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold">1</div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900 dark:text-gray-100">Add a YouTube Video</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Paste any YouTube URL to create a new learning topic.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-gradient-to-br from-indigo-600 to-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold">2</div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900 dark:text-gray-100">Take Timestamped Notes</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Write notes while watching. Each note captures the exact timestamp.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-gradient-to-br from-indigo-600 to-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold">3</div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900 dark:text-gray-100">Jump to Any Moment</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Click any note to instantly jump to that timestamp in the video.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-gradient-to-br from-indigo-600 to-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center font-bold">4</div>
                            <div class="ml-4">
                                <p class="font-semibold text-gray-900 dark:text-gray-100">Organize & Review</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Mark topics as complete and review your notes anytime.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
