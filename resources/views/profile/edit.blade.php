@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- <h1 class="text-white text-center text-xl">Edit Profile</h1> --}}

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('profile.edit', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <img src="{{ Storage::url('profile_photos/' . $user->profile_photo_url) }}"
                    class="rounded-full w-20 h-20 object-cover" alt="photo profile">
                <label for="profile_photo" class="mt-3 block text-white">Ubah Profile</label>
                <input type="file" id="profile_photo" name="profile_photo" class="form-control">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label text-white">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label text-white">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="bio" class="form-label text-white">Bio</label>
                <textarea class="form-control" id="bio" name="bio">{{ $user->bio ?? '' }}</textarea>
            </div>

            <button type="submit" class="btn btn-outline bg-sky-600 text-white hover:bg-sky-700 btn-md w-full">Save Changes</button>
        </form>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-outline bg-red-500 text-white hover:bg-red-700 btn-md w-full">Logout</button>
        </form>
    </div>
@endsection
