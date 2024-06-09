@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex">
        <!-- Main Content -->
        <div class="w-2/4 px-4 scrollbar-hide" style="height: 100vh; overflow-y: auto;">
            <!-- Header Buttons -->
            {{-- <div class="mb-4">
                <a href="{{ route('home.forYou') }}" class="btn {{ $type == 'for-you' ? 'btn-primary' : 'btn-secondary' }}">For You</a>
                <a href="{{ route('home.following') }}" class="btn {{ $type == 'following' ? 'btn-primary' : 'btn-secondary' }}">Following</a>
            </div> --}}
            
            <div>
                @foreach($posts as $post)
                    @include('components.post-card', ['post' => $post])
                @endforeach
            </div>
        </div>

        <!-- Sidebar -->
        <div class="w-[40%] px-4 bg-black">
            <div class="card bg-black text-white">
                <div class="card-header">
                    <h5>Siapa yang harus diikuti</h5>
                    <p>Orang yang mungkin anda kenal</p>
                </div>
                <div class="card-body">
                    @if ($recommendations->isEmpty())
                        <p>No recommendations available.</p>
                    @else
                        @foreach($recommendations as $user)
                            <div class="mb-2 text-white border border-slate-200 px-2 py-3 rounded-xl">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center ">
                                        <img src="{{ $user->profile_photo_url ? Storage::url('profile_photos/' . $user->profile_photo_url) : asset('default-avatar.png') }}" class="rounded-full w-10 h-10" alt="profile photo">
                                        <div class="ml-3">
                                            <div>{{ $user->name }}</div>
                                            <div class="italic text-slate-200">{{ $user->fullname }}</div>
                                        </div>
                                    </div>
                                    <a href="{{ route('follow', $user->id) }}" class="btn bg-white hover:text-slate-400">Follow</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
