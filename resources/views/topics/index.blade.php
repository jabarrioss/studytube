<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Learning Topics') }}
            </h2>
            <a href="{{ route('topics.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Add New Topic
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if($topics->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No topics yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Get started by adding your first YouTube learning video.</p>
                        <div class="mt-6">
                            <a href="{{ route('topics.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Add Your First Topic
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($topics as $topic)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition-shadow">
                            <a href="{{ route('topics.show', $topic) }}">
                                <img src="{{ $topic->thumbnail_url }}" alt="{{ $topic->title }}" class="w-full h-48 object-cover">
                            </a>
                            <div class="p-4">
                                <a href="{{ route('topics.show', $topic) }}" class="block">
                                    <h3 class="font-semibold text-lg text-gray-900 hover:text-indigo-600 line-clamp-2">
                                        {{ $topic->title }}
                                    </h3>
                                </a>
                                <div class="mt-3 flex items-center justify-between">
                                    <form action="{{ route('topics.toggle', $topic) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-sm {{ $topic->is_completed ? 'text-green-600' : 'text-gray-500' }} hover:text-green-700">
                                            @if($topic->is_completed)
                                                ✓ Completed
                                            @else
                                                Mark Complete
                                            @endif
                                        </button>
                                    </form>
                                    <div class="flex gap-2">
                                        <a href="{{ route('topics.show', $topic) }}" class="text-indigo-600 hover:text-indigo-900 text-sm">
                                            Study
                                        </a>
                                        <form action="{{ route('topics.destroy', $topic) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm">
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
