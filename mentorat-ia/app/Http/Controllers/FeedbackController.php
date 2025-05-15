<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $feedback = Feedback::create($request->validate([
            'session_id' => 'required|exists:sessions,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
            'submitted_at' => 'nullable|date'
        ]));

        return response()->json($feedback, 201);
    }

    public function sessionFeedback($sessionId)
    {
        return Feedback::where('session_id', $sessionId)->with('user')->get();
    }
}