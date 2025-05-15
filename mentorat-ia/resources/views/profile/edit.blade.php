@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="flex items-center justify-center min-h-screen px-4">
  <div class="bg-white bg-opacity-90 p-8 rounded-2xl shadow-lg w-full max-w-md transition transform hover:scale-[1.01] duration-300">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Edit Your Profile</h1>

    {{-- Success Message --}}
    @if(session('status'))
      <div class="mb-4 text-green-600 font-medium">
        {{ session('status') }}
      </div>
    @endif

    {{-- Back to Dashboard --}}
    <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline text-sm mb-6 inline-block">
      ← Back to Dashboard
    </a>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      {{-- Current Avatar --}}
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1 text-gray-700">Current Avatar</label>
        <div class="h-24 w-24 rounded-full overflow-hidden border shadow-sm">
          <img
            src="{{ $user->profile_image 
                     ? asset('storage/'.$user->profile_image)
                     : asset('images/avatar.png') }}"
            alt="Avatar"
            class="h-full w-full object-cover"
          >
        </div>
      </div>

      {{-- Upload New Image --}}
      <div class="mb-4">
        <label for="profile_image" class="block text-sm font-medium text-gray-700">
          New Profile Image
        </label>
        <input type="file" name="profile_image" id="profile_image"
               class="mt-1 block w-full text-sm text-gray-700" />
        @error('profile_image')
          <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
      </div>

      {{-- Name --}}
      <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input id="name" name="name" value="{{ old('name', $user->name) }}"
               class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
               required>
        @error('name')
          <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
      </div>

      {{-- Email --}}
      <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input id="email" name="email" type="email"
               value="{{ old('email', $user->email) }}"
               class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
               required>
        @error('email')
          <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
      </div>

      {{-- Expertise --}}
      <div class="mb-4">
        <label for="expertise" class="block text-sm font-medium text-gray-700">
          Expertise / Field
        </label>
        <input id="expertise" name="expertise"
               value="{{ old('expertise', $user->expertise) }}"
               class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
        @error('expertise')
          <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
      </div>

      {{-- Skills (for mentors only) --}}
      @if($user->role === 'mentor')
        <div class="mb-4">
          <label for="skills" class="block text-sm font-medium text-gray-700">
            Skills (comma-separated)
          </label>
          <input id="skills" name="skills"
                 value="{{ old('skills', $skills) }}"
                 class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
          @error('skills')
            <p class="text-red-500 text-sm">{{ $message }}</p>
          @enderror
        </div>
      @endif

      {{-- Bio --}}
      <div class="mb-4">
        <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
        <textarea id="bio" name="bio" rows="4"
                  class="mt-1 block w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('bio', $user->bio) }}</textarea>
        @error('bio')
          <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
      </div>

      {{-- Submit --}}
      <div class="flex justify-end">
        <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition transform hover:scale-105">
          Update Profile
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
