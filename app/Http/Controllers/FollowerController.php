<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(Request $request, User $user)
    {
        $follower = Follower::where('user_id', auth()->id())->where('follower_id', $user->id)->first();

        if ($follower) {
            return back()->with('info', 'You are already following this user.');
        }

        Follower::create([
            'user_id' => auth()->id(),
            'follower_id' => $user->id,
        ]);

        return back()->with('success', 'User followed successfully.');
    }

    public function destroy(User $user)
    {
        $follower = Follower::where('user_id', auth()->id())->where('follower_id', $user->id)->first();

        if ($follower) {
            $follower->delete();
            return back()->with('success', 'User unfollowed successfully.');
        }

        return back()->with('info', 'You are not following this user.');
    }
}

