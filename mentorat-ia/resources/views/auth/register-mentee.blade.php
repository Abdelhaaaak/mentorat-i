@extends('layouts.guest')

@section('title', 'Inscription Mentee')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow mt-12">
    <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Mentee Registration</h2>

    <form method="POST" action="{{ route('register.mentee.store') }}">
        @csrf

        {{-- Name --}}
        <label class="block mb-4">
            <span class="text-gray-700">Name</span>
            <input name="name" type="text" required
                   class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400" />
        </label>

        {{-- Email --}}
        <label class="block mb-4">
            <span class="text-gray-700">Email</span>
            <input name="email" type="email" required
                   class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400" />
        </label>

        {{-- Password --}}
        <label class="block mb-4">
            <span class="text-gray-700">Password</span>
            <input name="password" type="password" required
                   class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400" />
        </label>

        {{-- Interests (optional) --}}
        <label class="block mb-6">
            <span class="text-gray-700">Interests (optional)</span>
            <input name="interests" type="text"
                   class="w-full border px-3 py-2 rounded focus:ring-2 focus:ring-blue-400" />
        </label>

        {{-- Submit --}}
        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
            Register as Mentee
        </button>
    </form>
</div>
@endsection
