@extends('layouts.app')

@section('title', $user->name)

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8 space-y-6">

    {{-- Profile Header --}}
    <div class="flex items-center gap-6">
        <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('images/avatar.png') }}"
             alt="{{ $user->name }}"
             class="h-24 w-24 rounded-full object-cover border-2 border-gray-200">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
            <p class="text-gray-600 capitalize">{{ $user->role }}</p>

            {{-- Follow / Unfollow --}}
            @auth
                @if(auth()->id() !== $user->id)
                    <form method="POST" action="{{ route('follow.toggle', $user->id) }}" class="mt-2">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            {{ auth()->user()->following->contains($user->id) ? 'Unfollow' : 'Follow' }}
                        </button>
                    </form>
                @endif
            @endauth
        </div>
    </div>

    {{-- Bio --}}
    @if($user->bio)
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Bio</h2>
            <p class="text-gray-700 leading-relaxed">{{ $user->bio }}</p>
        </div>
    @endif

    {{-- Mentor-specific info --}}
    @if($user->mentor)
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Expertise</h2>
            <p class="text-gray-700">{{ $user->mentor->expertise }}</p>
        </div>
    @endif

    {{-- Mentee-specific info --}}
    @if($user->mentee && $user->mentee->interests)
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Interests</h2>
            <p class="text-gray-700">{{ $user->mentee->interests }}</p>
        </div>
    @endif

    {{-- Skills --}}
    @if(isset($skills) && count($skills))
        <div>
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Skills</h2>
            <ul class="flex flex-wrap gap-2">
                @foreach($skills as $skill)
                    <li class="bg-gray-100 px-3 py-1 rounded-full text-sm text-gray-800">{{ $skill }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</div>
@endsection
