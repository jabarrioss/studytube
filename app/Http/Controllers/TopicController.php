<?php

namespace App\Http\Controllers;

use App\Models\Tenant\Topic;
use App\Services\YouTubeMetadataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Check topic limit for free users (not admin, not pana, not premium)
        $user = Auth::user();
        if (!$user->isAdmin() && !$user->isPana() && !$user->subscribed('premium')) {
            $topicCount = Topic::count();
            if ($topicCount >= 5) {
                return back()->withErrors([
                    'youtube_url' => 'You have reached the maximum of 5 topics. Upgrade to Premium to create unlimited topics.'
                ])->withInput();
            }
        }

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
