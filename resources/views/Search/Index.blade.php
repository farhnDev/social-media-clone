@extends('layouts.app')

@section('content')
    <div class="container h-screen">
        
        <!-- Form pencarian -->
        <form action="{{ route('search.index') }}" method="GET">
            <div class="mb-3">
                <label for="search" class="form-label text-white">Cari Username</label>
                <input type="text" class="form-control h-12" id="search" name="query" placeholder="Masukkan username">
            </div>
        </form>
        
        <h1 class="text-white">Hasil Pencarian</h1>
        <br>
        @if ($results->isEmpty())
            <p class="text-white mt-10 text-center">Tidak ditemukan hasil untuk pencarian ini.</p>
        @else
            <div class="flex flex-col w-1/2">
                @foreach ($results as $result)
                    <div class="mb-2 text-white border border-slate-200 px-2 py-3 rounded-xl">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <img src="{{ $result->profile_photo_url ? Storage::url('profile_photos/' . $result->profile_photo_url) : asset('default-avatar.png') }}" class="rounded-full w-10 h-10" alt="profile photo">
                                <div class="ml-3">
                                    <div>{{ $result->name }}</div>
                                    <div class="italic text-slate-200">{{ $result->fullname }}</div>
                                </div>
                            </div>
                            <a href="{{ route('follow', $result->id) }}" class="btn bg-white hover:text-slate-400">Follow</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
