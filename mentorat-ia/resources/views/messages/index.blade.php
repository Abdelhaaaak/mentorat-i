<!-- resources/views/messages/index.blade.php -->
@extends('layouts.app')

@section('title', ' message')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white p-6 rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Messagerie</h2>

    <div class="border rounded-lg overflow-hidden max-h-[500px] mb-4">
        <div class="p-4 space-y-4 overflow-y-auto h-[300px]">
            @forelse ($messages as $message)
                <div class="flex {{ $message->sender_id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div class="px-4 py-2 rounded-lg text-white 
                        {{ $message->sender_id === auth()->id() ? 'bg-blue-600' : 'bg-gray-500' }}">
                        {{ $message->content }}
                        <div class="text-xs text-gray-200 mt-1 text-right">
                            {{ $message->created_at->format('H:i d/m') }}
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">Aucun message pour le moment.</p>
            @endforelse
        </div>
    </div>

    <form action="{{ route('messages.store') }}" method="POST" class="flex gap-4">
        @csrf
        <input type="hidden" name="recipient_id" value="{{ $recipient->id }}">

        <input type="text" name="content" placeholder="Écrire un message..." class="flex-grow px-4 py-2 border rounded-lg" required>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Envoyer
        </button>
    </form>
</div>