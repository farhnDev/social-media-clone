@extends('layouts.app')

@section('content')
    <div class="container h-screen">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.store') }}" class="pt-20" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="caption" class="form-label text-white">Caption</label>
                <textarea class="textarea textarea-bordered w-full" id="caption" name="caption" required>{{ old('caption') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image_path" class="form-label text-white">Upload Image</label>
                <input type="file" class="form-control" id="image_path" name="image_path" required>
            </div>

            <button type="submit" class="btn w-full btn-primary">Posting</button>
        </form>
    </div>
@endsection
