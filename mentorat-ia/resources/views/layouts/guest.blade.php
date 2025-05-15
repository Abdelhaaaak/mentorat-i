{{-- resources/views/layouts/guest.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name','MyMentor') }} – @yield('title','Welcome')</title>

  {{-- Tailwind + Alpine + Vite --}}
  @vite(['resources/css/app.css','resources/js/app.js'])

  {{-- Keyframes & utility styles --}}
  <style>
    @keyframes gradient-pan {
      0%   { background-position: 0% 50%; }
      100% { background-position: -200% 50%; }
    }
    .animate-gradient-pan {
      background-size: 300% 300%;
      animation: gradient-pan 15s ease infinite;
    }

    @keyframes scroll {
      0%   { transform: translateX(100%); }
      100% { transform: translateX(-100%); }
    }
    .animate-scroll { animation: scroll 25s linear infinite; }

    @keyframes fadeInUp {
      0%   { opacity: 0; transform: translateY(30px) scale(0.95); }
      100% { opacity: 1; transform: translateY(0) scale(1); }
    }
    .fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
  </style>
</head>

<body class="relative antialiased min-h-screen overflow-x-hidden flex flex-col">

  {{-- Full-screen animated gradient --}}
  <div class="fixed inset-0 bg-gradient-to-r from-indigo-500 via-teal-400 to-indigo-500
              animate-gradient-pan pointer-events-none"></div>

  {{-- Navbar --}}
  <nav class="relative z-20 bg-white bg-opacity-80 backdrop-blur-md shadow">
    <div class="container mx-auto px-6 py-4 flex items-center justify-between">
      <a href="{{ route('home') }}" class="flex items-center space-x-2">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
        <span class="font-bold text-xl text-gray-800">{{ config('app.name','MyMentor') }}</span>
      </a>
      <div class="hidden md:flex space-x-6">
        <a href="{{ route('profile.index') }}"
           class="relative text-gray-700 hover:text-blue-600 transition before:absolute before:-bottom-1 before:left-0
                  before:h-0.5 before:w-0 before:bg-blue-600 hover:before:w-full before:transition-all before:duration-300">
          Our Mentors
        </a>
      </div>
      <div class="hidden md:flex">
        <a href="{{ route('login') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
          Connexion
        </a>
      </div>
    </div>
  </nav>

  {{-- Page Content --}}
  <main class="relative z-10 container mx-auto px-4 py-12">
    @yield('content')
  </main>
    <section class="relative z-10 container mx-auto px-6 py-16">
  <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
    
    <!-- Card 1 -->
    <div
      class="bg-white p-6 rounded-2xl shadow-md transform transition duration-500 ease-in-out hover:-translate-y-2 hover:shadow-2xl hover:bg-blue-50 hover:scale-105"
    >
      <div class="text-4xl mb-4 transition-transform duration-300 hover:rotate-6">🎓</div>
      <h3 class="text-xl font-semibold mb-2 text-gray-800 transition-colors duration-300 hover:text-blue-600">
        Expert Guidance
      </h3>
      <p class="text-gray-600 transition-colors duration-300 hover:text-gray-800">
        Connect 1-on-1 with industry pros to accelerate your career.
      </p>
    </div>

    <!-- Card 2 -->
    <div
      class="bg-white p-6 rounded-2xl shadow-md transform transition duration-500 ease-in-out hover:-translate-y-2 hover:shadow-2xl hover:bg-green-50 hover:scale-105"
    >
      <div class="text-4xl mb-4 transition-transform duration-300 hover:rotate-6">🔥</div>
      <h3 class="text-xl font-semibold mb-2 text-gray-800 transition-colors duration-300 hover:text-green-600">
        Live Workshops
      </h3>
      <p class="text-gray-600 transition-colors duration-300 hover:text-gray-800">
        Hands-on sessions on everything from coding to career growth.
      </p>
    </div>

    <!-- Card 3 -->
    <div
      class="bg-white p-6 rounded-2xl shadow-md transform transition duration-500 ease-in-out hover:-translate-y-2 hover:shadow-2xl hover:bg-purple-50 hover:scale-105"
    >
      <div class="text-4xl mb-4 transition-transform duration-300 hover:rotate-6">💬</div>
      <h3 class="text-xl font-semibold mb-2 text-gray-800 transition-colors duration-300 hover:text-purple-600">
        Community Support
      </h3>
      <p class="text-gray-600 transition-colors duration-300 hover:text-gray-800">
        Join peer groups, ask questions, and thrive together.
      </p>
    </div>

  </div>
</section>

  {{-- Scrolling school logos --}}
  <div class="relative z-10 w-full overflow-hidden bg-white bg-opacity-10 py-6">
    <div class="flex items-center space-x-12 animate-scroll">
      @php
        $schools = ['UCA','UM5','UM6P','ENCG','INPT','ENSA','EMI','ISCAE','ENSAF','ENSAJ'];
      @endphp
      @foreach(array_merge($schools, $schools) as $abbr)
        <div class="flex-none px-6 flex flex-col items-center space-y-1">
          <img src="{{ asset("images/logos/{$abbr}.png") }}"
               alt="{{ $abbr }}"
               class="h-16 object-contain rounded-lg shadow"/>
          <span class="text-sm font-semibold text-gray-800">{{ $abbr }}</span>
        </div>
      @endforeach
    </div>
  </div>
{{-- platform description --}}
  <section class="relative z-10 container mx-auto px-6 py-16">
    <div class="grid md:grid-cols-2 gap-12 items-center">
      <div class="fade-in-up" style="animation-delay:0.2s">
        <h2 class="text-3xl font-bold mb-4 text-gray-800">Why MyMentor?</h2>
        <p class="text-lg text-gray-600 leading-relaxed mb-6">
          MyMentor is a dynamic platform that connects passionate mentors and eager mentees across Morocco.
          Whether you’re a student seeking guidance or a professional ready to give back, MyMentor makes mentorship accessible, impactful, and personal.
        </p>
        <ul class="list-disc pl-5 space-y-2 text-gray-700">
          <li>1-on-1 personalized sessions</li>
          <li>Diverse expert community</li>
          <li>Free and accessible to all students</li>
          <li>Promoting academic and career growth</li>
        </ul>
      </div>
      <div class="grid grid-cols-2 gap-4 fade-in-up" style="animation-delay:0.4s">
        <img src="{{ asset('images/showcase/mentoring1.jpg') }}" alt="" class="rounded-xl shadow-lg object-cover w-full h-48">
        <img src="{{ asset('images/showcase/mentoring2.jpg') }}" alt="" class="rounded-xl shadow-lg object-cover w-full h-48">
        <img src="{{ asset('images/showcase/mentoring3.jpg') }}" alt="" class="rounded-xl shadow-lg object-cover w-full h-48 col-span-2">
      </div>
    </div>
  </section>

  {{-- Footer --}}
  <footer class="bg-white bg-opacity-90 py-4">
    <div class="container mx-auto flex items-center justify-center space-x-2">
      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-6">
      <span class="text-gray-600">© {{ date('Y') }} {{ config('app.name','MyMentor') }}. All rights reserved.</span>
    </div>
  </footer>

</body>
</html>
