<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image'))
        {
            $data['image'] = uploadImage($request->file('image'),'posts');
        }
        auth()->user()->posts()->create($data);
        return to_route('posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string',
                'image' => 'nullable|image|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $oldImagePath = $post->image;
                $data['image'] = uploadImage($request->file('image'), 'posts');
                if ($oldImagePath) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }

            $post->update($data);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            \Log::error('Error updating post: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image)
        {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return response()->json(['success' => true]);

    }
}
