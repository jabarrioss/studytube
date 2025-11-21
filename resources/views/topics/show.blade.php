<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $topic->title }}
            </h2>
            <a href="{{ route('topics.index') }}" class="text-indigo-600 hover:text-indigo-900">
                ← Back to Topics
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Video Player Column -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <!-- Alpine.js Video Player Component -->
                        <div x-data="videoPlayer('{{ $topic->youtube_id }}')" x-init="initPlayer()">
                            <!-- YouTube Player Container -->
                            <div id="youtube-player" class="w-full aspect-video bg-black"></div>

                            <!-- Video Controls Info -->
                            <div class="p-4 bg-gray-50 border-t">
                                <div class="flex items-center justify-between text-sm text-gray-600">
                                    <span>Current Time: <span x-text="formatTime(currentTime)" class="font-mono"></span></span>
                                    <span>Duration: <span x-text="formatTime(duration)" class="font-mono"></span></span>
                                </div>
                            </div>

                            <!-- Add Note Form -->
                            <div class="p-6 border-t">
                                <h3 class="text-lg font-semibold mb-4">Add Note at Current Time</h3>
                                <form method="POST" action="{{ route('notes.store', $topic) }}" @submit="submitNote($event)">
                                    @csrf
                                    <input type="hidden" name="timestamp_seconds" x-model="currentTime">
                                    <div class="mb-4">
                                        <textarea 
                                            name="content" 
                                            rows="3" 
                                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            placeholder="Write your note here..."
                                            required></textarea>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-gray-500">
                                            Note will be saved at <span x-text="formatTime(currentTime)" class="font-mono font-semibold"></span>
                                        </span>
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                            Add Note
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-semibold mb-4">Notes ({{ $topic->notes->count() }})</h3>

                            @if($topic->notes->isEmpty())
                                <p class="text-gray-500 text-sm text-center py-8">
                                    No notes yet. Add your first note while watching the video!
                                </p>
                            @else
                                <div class="space-y-4">
                                    @foreach($topic->notes->sortBy('timestamp_seconds') as $note)
                                        <div class="border-l-4 border-indigo-500 pl-4 py-2 hover:bg-gray-50" 
                                             x-data="videoPlayer('{{ $topic->youtube_id }}')">
                                            <button 
                                                @click="seekToTime({{ $note->timestamp_seconds }})"
                                                class="text-indigo-600 hover:text-indigo-900 font-mono text-sm font-semibold mb-1 block">
                                                {{ $note->formatted_timestamp }}
                                            </button>
                                            <p class="text-sm text-gray-700">{{ $note->content }}</p>
                                            <div class="mt-2 flex gap-2">
                                                <form action="{{ route('notes.destroy', [$topic, $note]) }}" method="POST" onsubmit="return confirm('Delete this note?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-xs text-red-600 hover:text-red-900">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Global YouTube Player instance
        let globalPlayer = null;

        function videoPlayer(videoId) {
            return {
                videoId: videoId,
                player: null,
                currentTime: 0,
                duration: 0,
                updateInterval: null,

                initPlayer() {
                    // Wait for YouTube API to be ready
                    if (typeof YT !== 'undefined' && YT.Player) {
                        this.createPlayer();
                    } else {
                        window.onYouTubeIframeAPIReady = () => {
                            this.createPlayer();
                        };
                    }
                },

                createPlayer() {
                    this.player = new YT.Player('youtube-player', {
                        videoId: this.videoId,
                        playerVars: {
                            'playsinline': 1,
                            'modestbranding': 1,
                            'rel': 0
                        },
                        events: {
                            'onReady': (event) => this.onPlayerReady(event),
                            'onStateChange': (event) => this.onPlayerStateChange(event)
                        }
                    });
                    globalPlayer = this.player;
                },

                onPlayerReady(event) {
                    this.duration = event.target.getDuration();
                    this.startTimeTracking();
                },

                onPlayerStateChange(event) {
                    // YT.PlayerState.PLAYING = 1
                    if (event.data === 1) {
                        this.startTimeTracking();
                    } else {
                        this.stopTimeTracking();
                    }
                },

                startTimeTracking() {
                    if (this.updateInterval) return;
                    
                    this.updateInterval = setInterval(() => {
                        if (this.player && this.player.getCurrentTime) {
                            this.currentTime = Math.floor(this.player.getCurrentTime());
                        }
                    }, 1000);
                },

                stopTimeTracking() {
                    if (this.updateInterval) {
                        clearInterval(this.updateInterval);
                        this.updateInterval = null;
                    }
                },

                seekToTime(seconds) {
                    if (globalPlayer && globalPlayer.seekTo) {
                        globalPlayer.seekTo(seconds, true);
                        globalPlayer.playVideo();
                    }
                },

                formatTime(seconds) {
                    const mins = Math.floor(seconds / 60);
                    const secs = seconds % 60;
                    return `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
                },

                submitNote(event) {
                    // Form will submit normally, just ensure we have the latest time
                    if (this.player && this.player.getCurrentTime) {
                        this.currentTime = Math.floor(this.player.getCurrentTime());
                    }
                }
            }
        }
    </script>
</x-app-layout>
