<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SessionMM;

class SessionMMController extends Controller
{
    public function create(User $mentor)
    {
        return view('sessions.create', compact('mentor'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mentor_id' => 'required|exists:users,id',
            'scheduled_at' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $data['mentee_id'] = auth()->id();
        $data['status'] = 'pending';

        SessionMM::create($data);

        return redirect()->route('sessions.index')->with('success', 'Session booked successfully!');
    }

    public function index()
    {
        $user = auth()->user();

        $sessions = SessionMM::where('mentee_id', $user->id)
                             ->orWhere('mentor_id', $user->id)
                             ->with(['mentor', 'mentee'])
                             ->latest()
                             ->get();

        return view('sessions.index', compact('sessions'));
    }

    public function updateStatus(Request $request, SessionMM $session)
{
    $request->validate([
        'status' => 'required|in:accepted,declined',
    ]);

    $session->update([
        'status' => $request->status,
    ]);

    return redirect()->back()->with('success', 'Statut de la session mis à jour avec succès.');
}
}