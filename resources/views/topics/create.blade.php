<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                Add New Topic
            </h2>
            <a href="{{ route('topics.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition font-medium">
                ← Back to Topics
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-200 dark:border-gray-700">
                <div class="p-8">
                    <div class="mb-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">Add a YouTube Video</h3>
                        <p class="text-gray-600 dark:text-gray-400">Start your learning journey by adding any YouTube video</p>
                        @if(!Auth::user()->isAdmin() && !Auth::user()->isPana() && !Auth::user()->subscribed('premium'))
                            @php
                                $topicCount = \App\Models\Tenant\Topic::count();
                            @endphp
                            <div class="mt-4 inline-flex items-center px-4 py-2 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
                                <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-yellow-700 dark:text-yellow-300">
                                    <strong>Free Plan:</strong> {{ $topicCount }}/5 topics used. 
                                    <a href="{{ route('premium.index') }}" class="underline hover:text-yellow-900 dark:hover:text-yellow-100">Upgrade to Premium</a> for unlimited topics.
                                </span>
                            </div>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('topics.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="youtube_url" class="block font-semibold text-sm text-gray-700 dark:text-gray-300 mb-2">
                                YouTube URL
                            </label>
                            <input id="youtube_url" 
                                   class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 rounded-lg shadow-sm transition" 
                                   type="url" 
                                   name="youtube_url" 
                                   value="{{ old('youtube_url') }}" 
                                   required 
                                   autofocus
                                   placeholder="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                            @error('youtube_url')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                            <div class="mt-2 bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-800 rounded-lg p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-indigo-600 dark:text-indigo-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-indigo-700 dark:text-indigo-300">
                                            <strong>Pro tip:</strong> We'll automatically fetch the video title and thumbnail for you!
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-4 pt-4">
                            <a href="{{ route('topics.index') }}" class="px-6 py-3 text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 font-medium transition">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition shadow-md hover:shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Add Topic
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Help Section -->
            <div class="mt-8 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/10 dark:to-purple-900/10 rounded-xl p-6 border border-indigo-200 dark:border-indigo-800">
                <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-3">How to get started:</h4>
                <ol class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
                    <li class="flex items-start">
                        <span class="flex-shrink-0 w-6 h-6 bg-indigo-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3">1</span>
                        <span>Find any YouTube video you want to learn from</span>
                    </li>
                    <li class="flex items-start">
                        <span class="flex-shrink-0 w-6 h-6 bg-indigo-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3">2</span>
                        <span>Copy the video URL from your browser</span>
                    </li>
                    <li class="flex items-start">
                        <span class="flex-shrink-0 w-6 h-6 bg-indigo-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3">3</span>
                        <span>Paste it above and we'll set everything up for you</span>
                    </li>
                    <li class="flex items-start">
                        <span class="flex-shrink-0 w-6 h-6 bg-indigo-600 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3">4</span>
                        <span>Start taking timestamped notes as you watch!</span>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</x-app-layout>
