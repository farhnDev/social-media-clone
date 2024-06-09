@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex">
        <!-- Card Section -->
        <div class="w-full md:w-2/4 h-[100vh] px-4 overflow-y-auto scrollbar-hide">
            <!-- Card Section -->
            <div class="">
                @foreach($posts as $post)
                    @include('components.post-card', ['post' => $post])
                @endforeach
            </div>
        </div>

        <!-- Sidebar -->
        @isset($recommendations)
        <div class="hidden md:block w-1/4 px-4">
            <div class="card">
                <div class="card-header">
                    <h5>Siapa yang harus diikuti</h5>
                </div>
                <div class="card-body">
                    <p>Orang yang mungkin anda kenal</p>
                    @if ($recommendations->isEmpty())
                        <p>No recommendations available.</p>
                    @else
                        @foreach($recommendations as $user)
                            <div class="mb-2">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <img src="{{ $user->profile_photo_url ? Storage::url('profile_photos/' . $user->profile_photo_url) : asset('default-avatar.png') }}" class="rounded-full w-10 h-10" alt="profile photo">
                                        <div class="ml-3">
                                            <div>{{ $user->name }}</div>
                                            <div class="text-muted">{{ $user->fullname }}</div>
                                        </div>
                                    </div>
                                    <a href="{{ route('follow', $user->id) }}" class="btn btn-primary">Follow</a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        @endisset
    </div>
</div>
@endsection