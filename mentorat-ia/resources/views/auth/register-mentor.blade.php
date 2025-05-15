@extends('layouts.guest')

@section('title', 'Inscription Mentor')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow mt-12">
    <h2 class="text-2xl font-bold mb-6 text-center text-green-600">Mentor Registration</h2>

    <form method="POST" action="{{ route('register.mentor.store') }}">
        @csrf

        <label class="block mb-4">
            <span class="text-gray-700">Name</span>
            <input name="name" type="text" required class="w-full border px-3 py-2 rounded" />
        </label>

        <label class="block mb-4">
            <span class="text-gray-700">Email</span>
            <input name="email" type="email" required class="w-full border px-3 py-2 rounded" />
        </label>

        <label class="block mb-4">
            <span class="text-gray-700">Expertise</span>
            <input name="expertise" type="text" required class="w-full border px-3 py-2 rounded" />
        </label>

        <label class="block mb-4">
            <span class="text-gray-700">Bio</span>
            <textarea name="bio" class="w-full border px-3 py-2 rounded"></textarea>
        </label>

        <label class="block mb-6">
            <span class="text-gray-700">Password</span>
            <input name="password" type="password" required class="w-full border px-3 py-2 rounded" />
        </label>

        <button type="submit"
                class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700">
            Register
        </button>
    </form>
</div>
@endsection
