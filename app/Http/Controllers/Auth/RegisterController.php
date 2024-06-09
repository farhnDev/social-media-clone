<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $redirectTo = '/home';
    public function showProfile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'fullname' => $data['fullname'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // **Pengaturan URL Profil Default**
        $username = urlencode($user->name);
        $defaultProfileUrl = "https://avatar.iran.liara.run/username?username=$username";
        $user->profile_photo_url = $defaultProfileUrl;
        $user->save();

        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        Auth::login($user);

        return redirect($this->redirectTo);
    }
}
