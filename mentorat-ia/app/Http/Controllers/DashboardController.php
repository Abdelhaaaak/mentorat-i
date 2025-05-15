<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;

class DashboardController extends Controller
{
    /**
     * Show the user’s dashboard.
     */
    public function index()
    {
        $user = auth()->user();

        // Eager load related models
        $user->load('skills');

        // Fetch related data
        $messagesIn = $user->receivedMessages()->with('sender')->latest()->take(5)->get();
        $messagesOut = $user->sentMessages()->with('receiver')->latest()->take(5)->get();
        $sessionsMentor = $user->mentorSessions()->with('student')->latest()->take(5)->get();
        $sessionsStudent = $user->studentSessions()->with('mentor')->latest()->take(5)->get();

        // Feedback (if user is a mentor)
        $feedbacks = Feedback::where('mentor_id', $user->id)
                             ->with('author') // assuming you have a relationship to the author
                             ->latest()
                             ->take(5)
                             ->get();

        return view('dashboard', compact(
            'user',
            'messagesIn',
            'messagesOut',
            'sessionsMentor',
            'sessionsStudent',
            'feedbacks'
        ));
    }
    public function mentee()
{
    $user = auth()->user();

    $rawSessions = $user->studentSessions()
        ->with('mentor')
        ->where('scheduled_at', '>=', now())
        ->orderBy('scheduled_at')
        ->get();

    // Format sessions for FullCalendar
    $calendarSessions = $rawSessions->map(function ($session) {
        return [
            'title' => 'Session with ' . ($session->mentor->name ?? 'Unknown'),
            'start' => $session->scheduled_at->format('Y-m-d\TH:i:s'),
            'url'   => route('sessions.show', $session->id), // optional
        ];
    });

    $messages = $user->receivedMessages()
        ->with('sender')
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard.mentee', [
        'sessions' => $calendarSessions,
        'messages' => $messages,
    ]);
}



    /**
     * Show the mentor dashboard.
     */
    public function mentor()
{
    $user = auth()->user();

    $upcomingSessions = $user->mentorSessions()
        ->where('scheduled_at', '>=', now())
        ->with('mentee')
        ->orderBy('scheduled_at')
        ->take(5)
        ->get();

    $messages = $user->receivedMessages()->latest()->take(5)->get();

    $feedbacks = Feedback::where('mentor_id', $user->id)
        ->with('author')
        ->latest()
        ->take(5)
        ->get();

    $averageRating = Feedback::where('mentor_id', $user->id)->avg('rating') ?? 0;

    return view('dashboard.mentor', compact(
        'upcomingSessions',
        'messages',
        'feedbacks',
        'averageRating'
    ));
}

}

