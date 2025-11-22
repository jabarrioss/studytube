<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                My Learning Topics
            </h2>
            <a href="{{ route('topics.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition shadow-md hover:shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Topic
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 dark:bg-green-900/20 border-l-4 border-green-500 text-green-700 dark:text-green-300 p-4 rounded-lg shadow-md">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if($topics->isEmpty())
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="p-12 text-center">
                        <div class="flex justify-center mb-4">
                            <div class="bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/30 dark:to-purple-900/30 rounded-full p-6">
                                <svg class="h-16 w-16 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">No topics yet</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6 max-w-md mx-auto">Get started by adding your first YouTube learning video. Transform any video into an interactive learning experience with timestamped notes.</p>
                        <a href="{{ route('topics.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-indigo-700 hover:to-purple-700 transition shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Add Your First Topic
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($topics as $topic)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 sm:rounded-xl border border-gray-200 dark:border-gray-700 group">
                            <a href="{{ route('topics.show', $topic) }}" class="block">
                                <div class="relative overflow-hidden">
                                    <img src="{{ $topic->thumbnail_url }}" alt="{{ $topic->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>
                            </a>
                            <div class="p-5">
                                <a href="{{ route('topics.show', $topic) }}" class="block mb-3">
                                    <h3 class="font-semibold text-lg text-gray-900 dark:text-gray-100 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition line-clamp-2">
                                        {{ $topic->title }}
                                    </h3>
                                </a>
                                
                                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <form action="{{ route('topics.toggle', $topic) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="inline-flex items-center text-sm {{ $topic->is_completed ? 'text-green-600 dark:text-green-400' : 'text-gray-500 dark:text-gray-400' }} hover:text-green-700 dark:hover:text-green-300 transition">
                                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if($topic->is_completed)
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                @endif
                                            </svg>
                                            @if($topic->is_completed)
                                                Completed
                                            @else
                                                Mark Complete
                                            @endif
                                        </button>
                                    </form>
                                    
                                    <div class="flex gap-3">
                                        <a href="{{ route('topics.show', $topic) }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 text-sm font-medium transition">
                                            Study
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('topics.destroy', $topic) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this topic and all its notes?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 text-sm font-medium transition">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
