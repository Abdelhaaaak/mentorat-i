@extends('layouts.app')

@section('title', 'My Sessions')

@section('content')
<div class="max-w-5xl mx-auto py-6">
    <h2 class="text-3xl font-extrabold text-gray-800 mb-6">My Sessions</h2>

    @if($sessions->isEmpty())
        <div class="text-center py-12 text-gray-500">
            <p>No sessions yet. Book one with a mentor to get started.</p>
        </div>
    @else
        <div class="space-y-6">
            @foreach($sessions as $session)
                <div class="bg-white rounded-xl shadow-md p-6 transition hover:shadow-lg">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">
                                Session with {{ $session->mentor->name }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $session->scheduled_at->format('d M Y · H:i') }}
                            </p>
                        </div>
                        <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                                     {{ $session->status === 'accepted' ? 'bg-green-100 text-green-700' : 
                                        ($session->status === 'declined' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ ucfirst($session->status) }}
                        </span>
                    </div>

                    @if($session->notes)
                        <div class="text-sm text-gray-700 mb-2">
                            <strong>Notes:</strong> {{ $session->notes }}
                        </div>
                    @endif

                    {{-- Actions for mentors --}}
                    @if($session->status === 'pending' && auth()->id() === $session->mentor_id)
                        <div class="flex space-x-3 mt-4">
                            {{-- Accept --}}
                            <<form method="POST" action="{{ route('sessions.update', $session->id) }}">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="accepted">
                                <button type="submit">✅ Accept</button>
                            </form>


                            {{-- Decline --}}
                            <form action="{{ route('sessions.update', $session->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="declined">
                                <button type="submit"
                                        class="px-4 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                                    ❌ Decline
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
