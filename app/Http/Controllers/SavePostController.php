<?php
namespace App\Http\Controllers;

use App\Models\SavePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SavePostController extends Controller
{
    public function store(Post $post)
    {
        try {
            $savedPost = SavePost::where('user_id', Auth::id())->where('post_id', $post->id)->first();

            if ($savedPost) {
                return response()->json(['success' => false, 'message' => 'You have already saved this post.']);
            }

            SavePost::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id,
            ]);

            return response()->json(['success' => true, 'message' => 'Post saved successfully.']);
        } catch (\Exception $e) {
            // Logging the exception for debugging
            \Log::error('Error saving post: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred.']);
        }
    }

    public function destroy(Post $post)
    {
        try {
            $savedPost = SavePost::where('user_id', Auth::id())->where('post_id', $post->id)->first();

            if ($savedPost) {
                $savedPost->delete();
                return response()->json(['success' => true, 'message' => 'Post removed from saved successfully.']);
            }

            return response()->json(['success' => false, 'message' => 'You have not saved this post.']);
        } catch (\Exception $e) {
            // Logging the exception for debugging
            \Log::error('Error removing saved post: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred.']);
        }
    }
}
