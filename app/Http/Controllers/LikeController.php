<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        try {
            $like = Like::where('user_id', Auth::id())->where('post_id', $post->id)->first();

            if ($like) {
                return response()->json(['success' => false, 'message' => 'You already liked this post.']);
            }

            Like::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id,
            ]);

            return response()->json(['success' => true, 'message' => 'Post liked successfully.']);
        } catch (\Exception $e) {
            \Log::error('Error liking post: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred.']);
        }
    }

    public function destroy(Post $post)
{
    \Log::info('Attempting to unlike post: ' . $post->id . ' by user: ' . Auth::id());
    try {
        $like = Like::where('user_id', Auth::id())->where('post_id', $post->id)->first();

        if ($like) {
            $like->delete();
            \Log::info('Post unliked successfully');
            return response()->json(['success' => true, 'message' => 'Post unliked successfully.']);
        }

        \Log::warning('Post not liked by user');
        return response()->json(['success' => false, 'message' => 'You have not liked this post.']);
    } catch (\Exception $e) {
        \Log::error('Error unliking post: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'An error occurred.']);
    }
}

}
