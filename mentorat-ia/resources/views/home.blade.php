{{-- resources/views/home.blade.php --}}
@extends('layouts.guest')

@section('title','Welcome')

@section('content')
  <div class="mx-auto max-w-2xl bg-white p-8 rounded-xl shadow-xl text-center space-y-6">
    <h1 class="text-4xl font-bold">Find Your Perfect Mentor</h1>
    <p class="text-gray-600">Connect with experts from around the world and accelerate your growth.</p>
    <div class="space-x-4">
      <a href="{{ route('register.mentee') }}"
         class="px-6 py-2 bg-red-400 text-white rounded-lg hover:bg-red-500 transition">
        I’m a Mentee
      </a>
      <a href="{{ route('register.mentor') }}"
         class="px-6 py-2 bg-white text-gray-800 border rounded-lg hover:bg-gray-100 transition">
        I’m a Mentor
      </a>
    </div>
  </div>

  {{-- A little “about” card with fade-in --}}
  <div x-data x-intersect.once=" $el.classList.add('opacity-100','translate-y-0') "
       class="opacity-0 translate-y-6 transition-all duration-700
              mx-auto mt-16 max-w-3xl bg-white/80 p-8 rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold mb-4">Welcome to {{ config('app.name','Mentorat-IA') }}</h2>
    <p class="text-gray-700 mb-4">
      MentorAI is the platform that connects eager learners with expert mentors
      from around the world. Whether you’re looking to level up your skills,
      explore new fields, or get personalized advice, our community of
      verified mentors is here to guide you.
    </p>
    <ul class="space-y-2">
      <li class="flex items-center">
        <svg class="h-5 w-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path d="M16.7 5.3a1 1 0 00-1.4-1.4L8 11.2 4.7 7.9a1 1 0 10-1.4 1.4l4 4a1 1 0 001.4 0l8-8z"/>
        </svg>
        1-on-1 sessions tailored to your goals
      </li>
      <li class="flex items-center">
        <svg class="h-5 w-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path d="M16.7 5.3a1 1 0 00-1.4-1.4L8 11.2 4.7 7.9a1 1 0 10-1.4 1.4l4 4a1 1 0 001.4 0l8-8z"/>
        </svg>
        Seamless scheduling & in-app messaging
      </li>
      <li class="flex items-center">
        <svg class="h-5 w-5 text-purple-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
          <path d="M16.7 5.3a1 1 0 00-1.4-1.4L8 11.2 4.7 7.9a1 1 0 10-1.4 1.4l4 4a1 1 0 001.4 0l8-8z"/>
        </svg>
        Verified mentor profiles & skill endorsements
      </li>
    </ul>
  </div>
@endsection
