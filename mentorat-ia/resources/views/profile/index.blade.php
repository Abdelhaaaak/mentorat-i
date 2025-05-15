@extends('layouts.app')

@section('title', 'Mentors')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Tous les mentors</h1>
    </div>

    <!-- Search bar -->
    <div class="mb-6">
        <input
            type="text"
            placeholder="Rechercher mentors..."
            class="w-full md:w-1/3 px-4 py-2 border rounded-lg shadow-sm"
        />
    </div>

    <!-- Grid of mentor cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($mentors as $mentor)
            <div x-data="{ open: false }" class="bg-white p-4 shadow rounded-lg relative">
                <h3 class="font-semibold text-lg">{{ $mentor->name }}</h3>
                @if($mentor->expertise)
                    <p class="text-sm text-gray-600">{{ $mentor->expertise }}</p>
                @endif

                <div class="mt-4 flex justify-between items-center">
                    <a href="{{ route('profile.show', $mentor) }}"
                       class="text-blue-600 hover:underline text-sm">
                        Voir le profil
                    </a>
                    <a href="{{ route('sessions.create', $mentor) }}"
                  class="inline-block bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700 transition">
                   Book session
                  </a>

                </div>

                <!-- Modal (Scoped) -->
                <div
                    x-show="open"
                    x-transition
                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                >
                    <div class="bg-white p-6 rounded shadow-lg max-w-md w-full">
                        <h2 class="text-xl font-bold mb-4">Book a Session with {{ $mentor->name }}</h2>
                        <p class="mb-4 text-sm text-gray-600">
                            Select a time slot and start your journey.
                        </p>
                      
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
