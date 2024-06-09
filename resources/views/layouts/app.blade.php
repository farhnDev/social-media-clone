<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css') }}"
        rel="stylesheet">

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="{{ mix('/resources/css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-black">
    <div id="app" class="flex ">
        <!-- Sidebar -->
        <div class="bg-black w-64 border-r border-gray-200 p-4 flex flex-col">
            <div class="mb-8">
                <a class="text-xl text-slate-100 font-semibold hover:text-slate-100 hover:no-underline"
                    href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <nav class="flex flex-col space-y-2">
                <a href="{{ url('/home') }}"
                    class="text-slate-100 hover:border p-2 hover:text-slate-100 hover:no-underline rounded">
                    Home
                </a>
                <a href="{{ url('/search') }}"
                    class="text-slate-100 hover:border p-2 hover:text-slate-100 hover:no-underline rounded">
                    Search
                </a>
                <a class="text-slate-100 hover:border p-2 hover:text-slate-100 hover:no-underline rounded"
                    href="{{ route('posts.create') }}">New Post</a>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-black p-4 flex justify-between items-center">
                <div>
                    <a class="flex justify-center items-center text-xl text-slate-100 font-semibold hover:text-slate-100 hover:no-underline" href="{{ url('/home') }}">
                        <img src="{{ asset('images/logo.jpeg') }}" width="50" alt="bangke">
                        {{config('routes.name', 'Instagram')}}
                    </a>
                </div>
                @if (request()->is('home'))
                    <div class="flex space-x-4">
                        {{-- <a href="{{ route('home.forYou') }}"
                            class="btn {{ request()->is('home/for-you') ? 'btn-primary' : 'btn-secondary' }}">For
                            You</a>
                        <a href="{{ route('home.following') }}"
                            class="btn {{ request()->is('home/following') ? 'btn-primary' : 'btn-secondary' }}">Following</a> --}}
                        <a href="#" class="btn filter-btn" data-type="for-you">For You</a>
                        <a href="#" class="btn filter-btn" data-type="following">Following</a>
                    </div>
                @endif
                <div>
                    @auth
                        @php
                            $user = Auth::user();
                        @endphp
                        <a href="javascript:void(0);" class="text-gray-700 hover:text-gray-900" onclick="openModal()">
                            <img src="{{ Storage::url('profile_photos/' . $user->profile_photo_url) }}" width="40"
                                class="rounded-full object-cover h-[40px]" alt="photo profile">
                        </a>
                    @endauth
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-4 flex-1">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Password Modal -->
    <div id="passwordModal" class="hidden fixed z-10 inset-0 overflow-y-auto  items-center justify-center">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:mb-[18rem] sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Confirm Password
                            </h3>
                            <div class="mt-2">
                                <form id="passwordForm" method="POST">
                                    @csrf
                                    <div class="flex flex-wrap">
                                        <label for="password" class="block text-gray-700">Password</label>
                                        <input type="password" name="password" id="password"
                                            class="input input-bordered w-full p-2 border border-gray-300 rounded mt-1"
                                            required>
                                        <span id="passwordError" class="text-red-500 hidden">Incorrect password.</span>
                                        <div class="mt-4 flex gap-3">
                                            <button type="button"
                                                class="w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700"
                                                onclick="closeModal()">
                                                Cancel
                                            </button>
                                            <button type="submit"
                                                class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Confirm</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('passwordModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('passwordModal').classList.add('hidden');
        }

        document.getElementById('passwordForm').addEventListener('submit', function(event) {
            event.preventDefault();
            let password = document.getElementById('password').value;
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route('profile.verifyPassword') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        password: password
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '{{ route('profile.edit', Auth::user()->id) }}';
                    } else {
                        document.getElementById('passwordError').classList.remove('hidden');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const type = this.getAttribute('data-type');

                // Kirim permintaan AJAX
                fetch(`/home/${type}`)
                    .then(response => response.text())
                    .then(data => {
                        // Perbarui konten dengan data yang diterima
                        document.querySelector('.main-content').innerHTML = data;
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>
    <script src="{{ asset('https://code.jquery.com/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js') }}"></script>
</body>

</html>
