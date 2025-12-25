<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    //my stories
    public function myStories(Request $request)
    {
        $user = $request->user();
        $stories = $user->stories()->latest()->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Daftar cerita saya',
            'data' => $stories,
        ]);
    }

    //store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $story = new \App\Models\Story();
        $story->user_id = $request->user()->id;
        $story->title = $validated['title'];
        $story->content = $validated['content'];

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('stories', 'public');
            $story->image = $path;
        }

        $story->save();

        return response()->json([
            'status' => true,
            'message' => 'Cerita berhasil dibuat',
            'data' => $story->load('user'),
        ], 201);
    }

    //update
    public function update(Request $request, Story $story)
    {
        // Check ownership
        if ($request->user()->id !== $story->user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Anda tidak memiliki izin untuk mengupdate cerita ini',
            ], 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if (isset($validated['title'])) {
            $story->title = $validated['title'];
        }
        if (isset($validated['content'])) {
            $story->content = $validated['content'];
        }
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('stories', 'public');
            $story->image = $path;
        }
        $story->save();

        return response()->json([
            'status' => true,
            'message' => 'Cerita berhasil diupdate',
            'data' => $story->load('user'),
        ]);
    }

    //delete
    public function destroy(Request $request, Story $story)
    {
        // Check ownership
        if ($request->user()->id !== $story->user_id) {
            return response()->json([
                'status' => false,
                'message' => 'Anda tidak memiliki izin untuk menghapus cerita ini',
            ], 403);
        }

        $story->delete();

        return response()->json([
            'status' => true,
            'message' => 'Cerita berhasil dihapus',
        ]);
    }
}
