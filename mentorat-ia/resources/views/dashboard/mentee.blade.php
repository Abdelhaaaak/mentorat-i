@extends('layouts.app')

@section('title', 'Dashboard')

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
      <a href="{{ route('profile.index') }}" class="flex items-center space-x-3 hover:text-blue-600 transition">
        <img src="{{ asset('images/icons/users.svg') }}" class="h-6 w-6" alt="Mentors">
        <span>Our Mentors</span>
      </a>
      <a href="{{ route('mentor.ai') }}" class="flex items-center space-x-3 bg-blue-50 px-3 py-2 rounded hover:bg-blue-100 transition">
        <img src="{{ asset('images/icons/ai.svg') }}" class="h-6 w-6" alt="AI">
        <span class="font-semibold text-blue-700">Find My Mentor with AI</span>
      </a>
    </div>
  </aside>

  {{-- Main Dashboard Content --}}
  <section class="flex-1">
    <h2 class="text-2xl font-bold mb-4">Welcome back, {{ auth()->user()->name }}</h2>

    {{-- Calendar Placeholder --}}
    <div class="bg-white rounded-lg shadow p-6 mb-8">
      <h3 class="text-xl font-semibold mb-3">Your Upcoming Sessions</h3>
      <div id="calendar" class="bg-white rounded-lg shadow p-4"></div>

      Calendar coming soon...
      </div>
    </div>

    {{-- AI Section --}}
    <div class="bg-white rounded-lg shadow p-6">
      <h3 class="text-xl font-semibold mb-3">Need Help Finding a Mentor?</h3>
      <a href="{{ route('mentor.ai') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
        Find My Mentor with AI
      </a>
    </div>
  </section>
</div>
@endsection
@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const calendarEl = document.getElementById('calendar');

      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 500,
        events: @json($sessions ?? []), // Pass sessions as JSON from controller
        eventColor: '#3b82f6',
        eventTextColor: '#fff',
      });

      calendar.render();
    });
  </script>
@endpush
