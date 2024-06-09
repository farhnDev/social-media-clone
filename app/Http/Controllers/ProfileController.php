<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function verifyPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (Hash::check($request->password, $user->password)) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 401);
    }

    public function edit($id)
    {
        if (Auth::id() !== (int) $id) {
            abort(403);
        }

        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request, $id)
    {
        if (Auth::id() !== (int) $id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'bio' => 'nullable|string', // Allow optional bio with string validation
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;  // Update bio field

        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/profile_photos', $fileName); // Store image

            $user->profile_photo_url = $fileName;  // Update image URL
        }

        $user->save();

        return redirect()->route('profile.edit', $user->id)->with('status', 'Profile updated successfully!');
    }
}
