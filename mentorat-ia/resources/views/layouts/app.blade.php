<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MyMentor') }} – @yield('title', 'Welcome')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
    @push('head')
        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet">
    @endpush

    <style>
        @keyframes gradient-pan {
            0%   { background-position: 0% 50%; }
            100% { background-position: -200% 50%; }
        }
        .animate-gradient-pan {
            background-size: 300% 300%;
            animation: gradient-pan 15s ease infinite;
        }
    </style>
</head>
<body class="relative min-h-screen flex flex-col overflow-x-hidden antialiased">

    {{-- Animated Gradient Background --}}
    <div class="fixed inset-0 bg-gradient-to-r from-blue-400 via-purple-500 to-indigo-600 animate-gradient-pan -z-10"></div>

    {{-- Navbar --}}
    <nav class="relative z-20 bg-white bg-opacity-80 backdrop-blur-md shadow">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
                <span class="text-xl font-bold text-gray-800">{{ config('app.name', 'MyMentor') }}</span>
            </a>

            <div class="hidden md:flex space-x-6">
                <a href="{{ route('profile.index') }}" class="text-gray-700 hover:text-gray-900 transition">Our Mentors</a>
                <a href="#" class="text-gray-700 hover:text-gray-900 transition">Stories</a>
                <a href="#" class="text-gray-700 hover:text-gray-900 transition">About Us</a>
            </div>

            <div class="hidden md:flex items-center space-x-4">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 transition">Connexion</a>
                    <a href="{{ route('register.mentee') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition hover:scale-105">Sign Up</a>
                @else
                    <div x-data="notifications()" class="relative">
                        <button @click="open = !open" class="relative focus:outline-none">🔔
                            <span x-show="count>0" x-text="count" class="absolute -top-1 -right-2 bg-red-500 text-white text-xs rounded-full px-1"></span>
                        </button>
                        <div x-show="open" x-cloak @click.away="open=false" class="absolute right-0 mt-2 w-80 max-h-96 overflow-y-auto bg-white shadow-lg rounded z-50">
                            <div class="p-4 border-b flex justify-between items-center">
                                <span class="font-semibold">Notifications</span>
                                <button @click="markAllRead()" class="text-sm text-blue-600 hover:underline">Mark all read</button>
                            </div>
                            <template x-if="list.length === 0">
                                <p class="p-4 text-gray-500 text-sm">No new notifications</p>
                            </template>
                            <template x-for="note in list" :key="note.id">
                                <a href="#" class="block p-3 hover:bg-gray-100 border-b">
                                    <p x-text="note.data.message"></p>
                                    <small x-text="new Date(note.created_at).toLocaleString()" class="text-xs text-gray-400"></small>
                                </a>
                            </template>
                        </div>
                    </div>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="focus:outline-none">
                            <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('images/avatar.png') }}" class="h-8 w-8 rounded-full border-2 border-white">
                        </button>
                        <div x-show="open" x-cloak @click.away="open=false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
                            <a href="{{ route('profile.show', auth()->id()) }}" class="block px-4 py-2 hover:bg-gray-100">View Profile</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Edit Profile</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-1 container mx-auto px-6 py-8">
        @yield('content')

        {{-- Feature Cards only for guests --}}
        @guest
        <section class="py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="bg-white p-6 rounded-2xl shadow-md transform transition duration-500 hover:-translate-y-2 hover:shadow-xl hover:bg-blue-50 hover:scale-105">
                    <div class="text-4xl mb-4 transition-transform hover:rotate-6">🎓</div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 hover:text-blue-600">Expert Guidance</h3>
                    <p class="text-gray-600 hover:text-gray-800">Connect 1-on-1 with industry pros to accelerate your career.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-md transform transition duration-500 hover:-translate-y-2 hover:shadow-xl hover:bg-green-50 hover:scale-105">
                    <div class="text-4xl mb-4 transition-transform hover:rotate-6">🔥</div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 hover:text-green-600">Live Workshops</h3>
                    <p class="text-gray-600 hover:text-gray-800">Hands-on sessions on everything from coding to career growth.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-md transform transition duration-500 hover:-translate-y-2 hover:shadow-xl hover:bg-purple-50 hover:scale-105">
                    <div class="text-4xl mb-4 transition-transform hover:rotate-6">💬</div>
                    <h3 class="text-xl font-semibold mb-2 text-gray-800 hover:text-purple-600">Community Support</h3>
                    <p class="text-gray-600 hover:text-gray-800">Join peer groups, ask questions, and thrive together.</p>
                </div>
            </div>
        </section>
        @endguest
    </main>

    {{-- Footer --}}
    <footer class="bg-white bg-opacity-90 py-4 mt-auto">
        <div class="container mx-auto flex items-center justify-center space-x-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-6">
            <span class="text-gray-600">© {{ date('Y') }} {{ config('app.name','MyMentor') }}. All rights reserved.</span>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
