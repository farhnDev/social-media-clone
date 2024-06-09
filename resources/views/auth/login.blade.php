<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ mix('/resources/css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-black flex gap-32 justify-center items-center min-h-screen">
    <img src="{{ asset('images/logo.jpeg') }}" alt="bangke">
    <div class="bg-black rounded-lg shadow-md w-full max-w-lg">
        <h2 class="text-2xl text-slate-100 font-bold mb-6 text-center">Login</h2>
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline">There were some problems with your input.</span>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-slate-100">Name</label>
                    <input id="name" type="text"
                    class="input input-bordered w-full max-w-lg @error('name') input-error @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-slate-100">Password</label>
                <input id="password" type="password"
                    class="input input-bordered w-full max-w-lg @error('password') input-error @enderror" name="password"
                    required autocomplete="current-password">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="mb-4 flex items-center">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label ml-2" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div> --}}
            @if (Route::has('password.request'))
            <div class="my-3 gap-5 flex justify-beetwen">
                    <a class="text-slate-100 hover:text-primary" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    <a class="text-slate-100 hover:text-primary" href="{{ route('register') }}">
                        {{ __('do you have an account?') }}
                    </a>
                </div>
                @endif
                <div class="mb-4">
                    <button type="submit" class="btn bg-slate-100 w-full">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>
</body>

</html>
