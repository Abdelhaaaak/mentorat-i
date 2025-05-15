@extends('layouts.app')

@section('title', 'Mentor Dashboard')

@section('content')
<div class="flex">
  {{-- Sidebar --}}
  <aside class="w-64 bg-white shadow-md rounded-xl p-6 mr-6">
    <div class="flex flex-col space-y-6 text-gray-700">
      <a href="{{ route('sessions.index') }}" class="flex items-center space-x-3 hover:text-blue-600 transition">
        <img src="{{ asset('images/icons/calendar.svg') }}" class="h-6 w-6" alt="Sessions">
        <span>My Sessions</span>
      </a>
      <a href="{{ route('messages.index') }}" class="flex items-center space-x-3 hover:text-blue-600 transition">
        <img src="{{ asset('images/icons/chat.svg') }}" class="h-6 w-6" alt="Messages">
        <span>Messages</span>
      </a>
      <a href="{{ route('feedback.index') }}" class="flex items-center space-x-3 hover:text-blue-600 transition">
        <img src="{{ asset('images/icons/feedback.svg') }}" class="h-6 w-6" alt="Feedback">
        <span>Feedback</span>
      </a>
    </div>
  </aside>

  {{-- Main Dashboard Content --}}
  <section class="flex-1">
    <h2 class="text-2xl font-bold mb-4">Welcome back, {{ auth()->user()->name }}</h2>

    {{-- Sessions Overview --}}
    <div class="bg-white rounded-lg shadow p-6 mb-8">
      <h3 class="text-xl font-semibold mb-3">Upcoming Sessions</h3>
      <div id="calendar" class="bg-white rounded-lg shadow p-4">
        <p class="text-gray-500">Calendar integration coming soon…</p>
      </div>
    </div>

    {{-- Quick Info --}}
    <div class="bg-white rounded-lg shadow p-6">
      <h3 class="text-xl font-semibold mb-3">Recent Feedback</h3>
      <p class="text-gray-500">You can manage feedback from your mentees here.</p>
      <a href="{{ route('feedback.index') }}" class="mt-3 inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
        View Feedback
      </a>
    </div>
  </section>
</div>
@endsection
