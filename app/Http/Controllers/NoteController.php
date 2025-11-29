<?php

namespace App\Http\Controllers;

use App\Models\Tenant\Note;
use App\Models\Tenant\Topic;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function store(Request $request, Topic $topic)
    {
        $request->validate([
            'content' => 'required|string',
            'timestamp_seconds' => 'required|integer|min:0',
        ]);

        $note = $topic->notes()->create([
            'content' => $request->input('content'),
            'timestamp_seconds' => $request->input('timestamp_seconds'),
        ]);

        // Return JSON for AJAX requests
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Note added successfully!',
                'note' => [
                    'id' => $note->id,
                    'content' => $note->content,
                    'timestamp_seconds' => $note->timestamp_seconds,
                    'created_at_human' => $note->created_at->diffForHumans(),
                    'created_at' => $note->created_at,
                ],
            ]);
        }

        return back()->with('success', 'Note added successfully!');
    }

    public function update(Request $request, Topic $topic, Note $note)
    {
        $request->validate(['content' => 'required|string']);
        $note->update(['content' => $request->input('content')]);
        return back()->with('success', 'Note updated!');
    }

    public function destroy(Topic $topic, Note $note)
    {
        $note->delete();
        
        // Return JSON for AJAX requests
        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Note deleted!',
            ]);
        }
        
        return back()->with('success', 'Note deleted!');
    }
}
