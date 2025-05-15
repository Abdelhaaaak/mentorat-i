<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User; 
use Illuminate\Http\Request;
use App\Notifications\NewMessageNotification;

class MessageController extends Controller
{
    public function create(Request $request)
{
    $recipientId = $request->query('to');
    $recipient = User::findOrFail($recipientId);

    return view('messages.create', compact('recipient'));
}
public function index()
{
    $userId = auth()->id();

    $messages = Message::where('sender_id', $userId)
                ->orWhere('receiver_id', $userId)
                ->orderBy('created_at')
                ->get();

    return view('messages.index', [
        'messages' => $messages,
        'recipient' => auth()->user(), // ou une autre logique
    ]);
}


   public function store(Request $request)
{
    $validated = $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'content'     => 'required|string',
    ]);

    $message = new Message([
        'sender_id'   => auth()->id(),
        'receiver_id' => $validated['receiver_id'],
        'content'     => $validated['content'],
    ]);
    $message->save();

    $receiver = User::find($validated['receiver_id']);
    $receiver->notify(new NewMessageNotification($message));

    return redirect()->back()->with('success', 'Message sent.');
}

    public function conversation($senderId, $receiverId)
    {
        return Message::where(function ($q) use ($senderId, $receiverId) {
            $q->where('sender_id', $senderId)->where('receiver_id', $receiverId);
        })->orWhere(function ($q) use ($senderId, $receiverId) {
            $q->where('sender_id', $receiverId)->where('receiver_id', $senderId);
        })->orderBy('sent_at')->get();
    }
}