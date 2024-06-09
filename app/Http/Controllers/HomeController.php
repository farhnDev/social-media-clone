<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::with(['user', 'likes', 'comments'])->orderBy('created_at', 'desc')->get();

        $recommendations = User::where('id', '!=', Auth::id())
            ->whereDoesntHave('followers', function($query) {
                $query->where('follower_id', Auth::id());
            })
            ->take(5)
            ->get();

        return view('home', [
            'posts' => $posts,
            'recommendations' => $recommendations,
        ]);
    }
    
    public function forYou()
    {
        $posts = Post::with(['user', 'likes', 'comments'])->orderBy('created_at', 'desc')->get();

        $recommendations = User::where('id', '!=', Auth::id())
            ->whereDoesntHave('followers', function($query) {
                $query->where('follower_id', Auth::id());
            })
            ->take(5)
            ->get();

        return view('home', [
            'posts' => $posts,
            'recommendations' => $recommendations,
            'type' => 'for-you',
        ]);
    }
    
    public function following()
    {
        $user = Auth::user();
        $followingIds = $user->following()->pluck('id');

        $posts = Post::with(['user', 'likes', 'comments'])
            ->whereIn('user_id', $followingIds)
            ->orderBy('created_at', 'desc')
            ->get();

        $recommendations = User::where('id', '!=', Auth::id())
            ->whereDoesntHave('followers', function($query) {
                $query->where('follower_id', Auth::id());
            })
            ->take(5)
            ->get();

        return view('home', [
            'posts' => $posts,
            'recommendations' => $recommendations,
            'type' => 'following',
        ]);
    }

    public function follow(User $user)
    {
        Auth::user()->following()->attach($user->id);
        return back()->with('success', 'Successfully followed the user.');
    }
}
