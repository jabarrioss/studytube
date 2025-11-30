<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight line-clamp-1">
                {{ $topic->title }}
            </h2>
            <a href="{{ route('topics.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 transition font-medium">
                ← Back to Topics
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-data="videoPlayerComponent('{{ $topic->youtube_id }}', {{ $topic->id }})">
                <!-- Video Player Column -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-200 dark:border-gray-700">
                        <!-- YouTube Player Container -->
                        <div id="youtube-player" class="w-full aspect-video bg-black"></div>

                        <!-- Ad Placeholder for Free Plan Users -->
                        @if(!Auth::user()->isAdmin() && !Auth::user()->isPremium() && !Auth::user()->isPana())
                            <div class="bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 border-y border-gray-300 dark:border-gray-600">
                                <div class="p-6 text-center">
                                    <div class="flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm font-semibold text-gray-600 dark:text-gray-300">Ad Space</span>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Advertisement placeholder for free plan users</p>
                                    <a href="{{ route('premium.index') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition shadow-md">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Remove ads with Premium
                                    </a>
                                </div>
                            </div>
                        @endif

                        <!-- Video Controls Info -->
                        <div class="p-4 bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-gray-700 dark:text-gray-300">Current: <span x-text="formatTime(currentTime)" class="font-mono font-semibold text-indigo-600 dark:text-indigo-400"></span></span>
                                </div>
                                <span class="text-gray-700 dark:text-gray-300">Duration: <span x-text="formatTime(duration)" class="font-mono font-semibold"></span></span>
                            </div>
                        </div>

                        <!-- Add Note Form -->
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center mb-4">
                                <div class="flex-shrink-0 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg p-2">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                                <h3 class="ml-3 text-lg font-semibold text-gray-900 dark:text-gray-100">Add Note at Current Time</h3>
                            </div>
                            <form @submit.prevent="saveNote">
                                <div class="mb-4">
                                    <textarea 
                                        x-model="noteContent"
                                        rows="4" 
                                        class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-indigo-500 dark:focus:border-indigo-400 focus:ring-indigo-500 dark:focus:ring-indigo-400 rounded-lg shadow-sm transition"
                                        placeholder="Write your note here... (supports markdown)"
                                        :disabled="saving"
                                        required></textarea>
                                </div>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                        <svg class="w-4 h-4 mr-1 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Note will be saved at <span x-text="formatTime(currentTime)" class="font-mono font-semibold text-indigo-600 dark:text-indigo-400"></span></span>
                                    </div>
                                    <button type="submit" :disabled="saving" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:from-indigo-700 hover:to-purple-700 transition shadow-md hover:shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
                                        <svg x-show="!saving" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                        </svg>
                                        <svg x-show="saving" class="animate-spin w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span x-text="saving ? 'Saving...' : 'Add Note'"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Notes Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-xl border border-gray-200 dark:border-gray-700 sticky top-6">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Notes</h3>
                                </div>
                                <span class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full" x-text="notes.length">
                                </span>
                            </div>

                            <div x-show="notes.length === 0" class="text-center py-12">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-indigo-100 to-purple-100 dark:from-indigo-900/30 dark:to-purple-900/30 rounded-full mb-4">
                                    <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </div>
                                <p class="text-gray-600 dark:text-gray-400 text-sm">
                                    No notes yet. Add your first note while watching the video!
                                </p>
                            </div>

                            <div x-show="notes.length > 0" class="space-y-3 max-h-[600px] overflow-y-auto">
                                <template x-for="note in notes" :key="note.id">
                                    <div class="border-l-4 border-indigo-500 dark:border-indigo-400 pl-4 py-3 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition rounded-r-lg group">
                                        <!-- Timestamp Button -->
                                        <button @click="seekTo(note.timestamp_seconds)" 
                                                class="flex items-center text-xs font-mono font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 mb-2 transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <span x-text="formatTime(note.timestamp_seconds)"></span>
                                        </button>

                                        <!-- Note Content -->
                                        <p class="text-sm text-gray-700 dark:text-gray-300 mb-2 whitespace-pre-wrap" x-text="note.content"></p>

                                        <!-- Note Actions -->
                                        <div class="flex items-center justify-between opacity-0 group-hover:opacity-100 transition">
                                            <span class="text-xs text-gray-500 dark:text-gray-400" x-text="note.created_at_human">
                                            </span>
                                            <button @click="deleteNote(note.id)" type="button" class="text-xs text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 transition">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('videoPlayerComponent', (youtubeId, topicId) => ({
                player: null,
                currentTime: 0,
                duration: 0,
                youtubeId: youtubeId,
                topicId: topicId,
                notes: @json($topic->notes->sortBy('timestamp_seconds')->values()),
                noteContent: '',
                saving: false,

                init() {
                    // Initialize player when component mounts
                    this.initPlayer();
                },

                initPlayer() {
                    // Wait for YouTube API to be ready
                    if (typeof YT === 'undefined' || typeof YT.Player === 'undefined') {
                        setTimeout(() => this.initPlayer(), 100);
                        return;
                    }

                    this.player = new YT.Player('youtube-player', {
                        videoId: this.youtubeId,
                        playerVars: {
                            'playsinline': 1,
                            'rel': 0,
                            'modestbranding': 1
                        },
                        events: {
                            'onReady': (event) => {
                                this.duration = event.target.getDuration();
                                this.startTimeTracking();
                            }
                        }
                    });
                },

                startTimeTracking() {
                    setInterval(() => {
                        if (this.player && this.player.getCurrentTime) {
                            this.currentTime = Math.floor(this.player.getCurrentTime());
                        }
                    }, 1000);
                },

                seekTo(seconds) {
                    if (this.player && this.player.seekTo) {
                        this.player.seekTo(seconds, true);
                        this.player.playVideo();
                    }
                },

                formatTime(seconds) {
                    const h = Math.floor(seconds / 3600);
                    const m = Math.floor((seconds % 3600) / 60);
                    const s = Math.floor(seconds % 60);
                    
                    if (h > 0) {
                        return `${h}:${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
                    }
                    return `${m}:${s.toString().padStart(2, '0')}`;
                },

                async saveNote() {
                    if (!this.noteContent.trim()) return;

                    this.saving = true;

                    try {
                        const response = await fetch(`/topics/${this.topicId}/notes`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                content: this.noteContent,
                                timestamp_seconds: this.currentTime
                            })
                        });

                        if (!response.ok) {
                            throw new Error('Failed to save note');
                        }

                        const data = await response.json();
                        
                        // Add new note to the array and sort by timestamp
                        this.notes.push(data.note);
                        this.notes.sort((a, b) => a.timestamp_seconds - b.timestamp_seconds);
                        
                        // Clear the form
                        this.noteContent = '';
                        
                    } catch (error) {
                        console.error('Error saving note:', error);
                        alert('Failed to save note. Please try again.');
                    } finally {
                        this.saving = false;
                    }
                },

                async deleteNote(noteId) {
                    if (!confirm('Delete this note?')) return;

                    try {
                        const response = await fetch(`/topics/${this.topicId}/notes/${noteId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        });

                        if (!response.ok) {
                            throw new Error('Failed to delete note');
                        }

                        // Remove note from array
                        this.notes = this.notes.filter(note => note.id !== noteId);
                        
                    } catch (error) {
                        console.error('Error deleting note:', error);
                        alert('Failed to delete note. Please try again.');
                    }
                }
            }));
        });
    </script>
    @endpush
</x-app-layout>
