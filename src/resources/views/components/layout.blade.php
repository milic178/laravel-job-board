<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Job board</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-black text-white font-hanken-grotesk pb-20">
<div class="px-10">
    <!-- Updated Nav Bar -->
    <nav class="flex justify-between items-center py-4 border-b border-white/10">
        <!-- Logo -->
        <div>
            <a href="/">
                <img src="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/logo.svg') }}" alt="Logo">
            </a>
        </div>

        <!-- Middle links (Jobs, Employers) -->
        <div class="space-x-6 font-bold hidden md:flex">
            <a href="/" class="hover:text-gray-400">Jobs</a>
            <a href="/employer" class="hover:text-gray-400">Employers</a>
        </div>

        <!-- When user is logged out -->
        @guest
            <div class="space-x-6 font-bold flex items-center">
                <a href="/register" class="hover:text-gray-400">Sign Up</a>
                <a href="/login" class="hover:text-gray-400">Login</a>
            </div>
        @endguest

        <!-- When user is logged in -->
        @auth
            <div class="flex items-center space-x-6">
                <!-- Post a Job button with margin -->
                <a href="/jobs/create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-bold mr-4">
                    Post a Job
                </a>

                <!-- Hamburger menu -->
                <div class="relative">
                    <button class="text-white focus:outline-none" id="hamburger-menu">
                        <!-- Hamburger icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <div id="menu-items" class="absolute right-0 mt-2 py-2 w-48 bg-white text-black rounded-lg shadow-xl hidden">
                        <a href="/user/edit" class="block px-4 py-2 text-sm text-black hover:bg-gray-200 hover:text-black shadow-lg">Account</a>
                        <hr class="border-gray-300">
                        @if (Auth::user()->employer)
                            <a href="/employers/{{ Auth::user()->employer->id }}/jobs" class="block px-4 py-2 text-sm text-black hover:bg-gray-200 hover:text-black shadow-lg">My Listed Jobs</a>
                        @endif
                        <a href="/employer" class="block px-4 py-2 text-sm text-black hover:bg-gray-200 hover:text-black shadow-lg">Employers</a>
                        <hr class="border-gray-300">
                        <form method="POST" action="/logout" class="block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-left text-sm px-4 py-2 text-black bg-white hover:bg-gray-200 hover:text-black shadow-none">Log Out</button>
                        </form>
                    </div>
                </div>
            </div>
        @endauth
    </nav>

    <!-- Main content section -->
    <main class="mt-10 max-w-[986px] mx-auto">
        {{ $slot }}
    </main>
</div>


</body>
</html>
