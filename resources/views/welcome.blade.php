<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Instagram Kami</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ mix('/resources/css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-black py-32 h-screen text-white">
    <header class="bg-black ">
        <div class="flex justify-center py-8">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo Instagram" class="max-w-xs">
        </div>
    </header>
    <main class="container mx-auto py-8">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold">Selamat Datang di Aplikasi Instagram Kami</h2>
        </div>
        <div class="flex justify-center">
            <div class="space-x-4">
                <button onclick="window.location='{{ route('login') }}'" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Login</button>
<button onclick="window.location='{{ route('register') }}'" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</button>

            </div>
        </div>
    </main>
    <footer class="bg-black text-center py-4">
        <p>Hak Cipta &copy; 2024 Contoh Perusahaan.</p>
    </footer>
</body>
</html>
