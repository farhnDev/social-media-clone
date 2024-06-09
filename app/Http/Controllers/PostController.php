<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required',
            'image_path' => 'required|image',
        ]);

        $imagePath = $request->file('image_path')->store('uploads', 'public');

        Post::create([
            'user_id' => auth()->id(),
            'caption' => $request->caption,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('home')
                         ->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'caption' => 'required',
        ]);

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('uploads', 'public');
            $post->update(['image_path' => $imagePath]);
        }

        $post->update($request->only('caption'));

        return redirect()->route('posts.index')
                         ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
                         ->with('success', 'Post deleted successfully.');
    }
}

