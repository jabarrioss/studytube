<?php

namespace App\Http\Controllers;

use App\Models\Tenant\Topic;
use App\Services\YouTubeMetadataService;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    protected $youtubeService;

    public function __construct(YouTubeMetadataService $youtubeService)
    {
        $this->youtubeService = $youtubeService;
    }

    public function index()
    {
        $topics = Topic::orderBy('created_at', 'desc')->get();
        return view('topics.index', compact('topics'));
    }

    public function create()
    {
        return view('topics.create');
    }

    public function store(Request $request)
    {
        $request->validate(['youtube_url' => 'required|url']);

        $videoId = $this->youtubeService->extractVideoId($request->youtube_url);
        if (!$videoId) {
            return back()->withErrors(['youtube_url' => 'Invalid YouTube URL']);
        }

        $metadata = $this->youtubeService->fetchMetadata($videoId);

        $topic = Topic::create([
            'title' => $metadata['title'],
            'youtube_url' => $request->youtube_url,
            'youtube_id' => $videoId,
            'thumbnail_url' => $metadata['thumbnail_url'],
        ]);

        return redirect()->route('topics.show', $topic)->with('success', 'Topic created successfully!');
    }

    public function show(Topic $topic)
    {
        $topic->load('notes');
        return view('topics.show', compact('topic'));
    }

    public function toggleComplete(Topic $topic)
    {
        $topic->update(['is_completed' => !$topic->is_completed]);
        return back()->with('success', 'Topic status updated!');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return redirect()->route('topics.index')->with('success', 'Topic deleted successfully!');
    }
}
