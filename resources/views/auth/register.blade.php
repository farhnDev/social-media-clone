<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="{{ mix('resources/css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-black flex gap-48 justify-center items-center min-h-screen">
    <div class="flex flex-col gap-20 mb-28">
        <h2 class="text-2xl font-bold mb-6 text-center text-slate-100">Register</h2>
        <img src="{{ asset('images/logo.jpeg') }}" alt="bangke">
    </div>
    <div class="bg-black p-8 rounded-lg shadow-md w-full max-w-2xl">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Whoops!</strong>
                <span class="block sm:inline">Isi form dengan data pribadi anda.</span>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="flex justify-between space-x-4 mb-4">
                <div class="w-1/2">
                    <label for="fullname" class="block text-gray-100">Fullname</label>
                    <input type="text" name="fullname" id="fullname" class="input w-full p-2 border border-gray-300 rounded mt-1" value="{{ old('fullname') }}">
                </div>
                <div class="w-1/2">
                    <label for="name" class="block text-gray-100">Username</label>
                    <input type="text" name="name" id="name" class="input w-full p-2 border border-gray-300 rounded mt-1" value="{{ old('name') }}">
                </div>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-100">Email</label>
                <input type="email" name="email" id="email" class="input w-full p-2 border border-gray-300 rounded mt-1" value="{{ old('email') }}">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-100">Password</label>
                <input type="password" name="password" id="password" class="input w-full p-2 border border-gray-300 rounded mt-1">
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-100">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="input w-full p-2 border border-gray-300 rounded mt-1">
            </div>
            <a href="/login" class="block text-white mb-5 hover:text-sky-500">sudah punya akun?</a>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Register</button>
        </form>
    </div>
</body>
</html>
