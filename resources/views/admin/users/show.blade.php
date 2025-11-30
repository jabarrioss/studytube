@extends('layouts.admin')

@section('title', 'User Details - ' . $user->name)

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.users.index') }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 text-sm">
        ← Back to Users
    </a>
</div>

<!-- User Info Card -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-6">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">User Information</h2>
        <div class="flex space-x-3">
            <a href="{{ route('admin.users.edit', $user) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm">
                Edit User
            </a>
        </div>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Name</label>
                <p class="text-lg text-gray-900 dark:text-white">{{ $user->name }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email</label>
                <p class="text-lg text-gray-900 dark:text-white">{{ $user->email }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">UUID</label>
                <p class="text-sm text-gray-700 dark:text-gray-300 font-mono">{{ $user->uuid }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Plan</label>
                <p class="text-lg text-gray-900 dark:text-white">{{ $user->plan ? $user->plan->name : 'Free' }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Admin Status</label>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->is_admin ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400' }}">
                    {{ $user->is_admin ? 'Admin' : 'Regular User' }}
                </span>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Joined</label>
                <p class="text-lg text-gray-900 dark:text-white">{{ $user->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <p class="text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wide">Total Topics</p>
        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['total_topics'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <p class="text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wide">Completed</p>
        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['completed_topics'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <p class="text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wide">Total Notes</p>
        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['total_notes'] }}</p>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <p class="text-sm text-gray-600 dark:text-gray-400 uppercase tracking-wide">Sessions</p>
        <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $stats['learning_sessions'] }}</p>
    </div>
</div>

<!-- Topics -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow mb-6">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Topics</h3>
    </div>
    <div class="p-6">
        @forelse($topics as $topic)
        <div class="mb-4 pb-4 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h4 class="text-lg font-medium text-gray-900 dark:text-white">{{ $topic->title }}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ Str::limit($topic->description, 100) }}</p>
                    <div class="flex items-center space-x-4 mt-2">
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $topic->notes_count }} notes</span>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Created {{ $topic->created_at->diffForHumans() }}</span>
                        @if($topic->is_completed)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                Completed
                            </span>
                        @endif
                    </div>
                </div>
                @if($topic->thumbnail_url)
                    <img src="{{ $topic->thumbnail_url }}" alt="{{ $topic->title }}" class="w-32 h-20 object-cover rounded ml-4">
                @endif
            </div>
        </div>
        @empty
        <p class="text-gray-500 dark:text-gray-400">No topics yet.</p>
        @endforelse
    </div>
</div>

<!-- Recent Notes -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Notes (Last 50)</h3>
    </div>
    <div class="p-6">
        @forelse($notes as $note)
        <div class="mb-4 pb-4 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center space-x-2 mb-1">
                        <span class="px-2 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-800 dark:text-indigo-400 text-xs rounded">
                            {{ gmdate('i:s', $note->timestamp_seconds) }}
                        </span>
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $note->topic->title }}</span>
                    </div>
                    <p class="text-gray-900 dark:text-white">{{ $note->content }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $note->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
        @empty
        <p class="text-gray-500 dark:text-gray-400">No notes yet.</p>
        @endforelse
    </div>
</div>
@endsection
