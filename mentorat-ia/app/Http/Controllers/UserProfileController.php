<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
   public function index(Request $request)
    {
        $search = $request->input('search');

        $query = User::with('skills')
                     ->where('role', 'mentor');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name',      'ILIKE', "%{$search}%")
                  ->orWhere('email',   'ILIKE', "%{$search}%")
                  ->orWhere('expertise','ILIKE', "%{$search}%")
                  ->orWhere('bio',     'ILIKE', "%{$search}%");
            });
        }

        $mentors = User::where('role', 'mentor')->orderBy('name')->paginate(15);

    return view('profile.index', compact('mentors'));
    }

    // … your show(), toggleFollow(), etc. …

    /**
     * Display the specified user's profile.
     */
    public function show(User $user)
    {
        // ensure skills relation is loaded
        $user->load('skills');

        // convert to array of names
        $skills = $user->skills->pluck('name')->toArray();

        // bio is stored on the model
        $bio = $user->bio;

        return view('profile.show', compact('user','skills','bio'));
    }
    public function toggleFollow(User $user)
{
    $authUser = auth()->user();

    if ($authUser->id === $user->id) {
        return back()->with('error', 'You cannot follow yourself.');
    }

    // Check if already following
    if ($authUser->following()->where('user_id', $user->id)->exists()) {
        $authUser->following()->detach($user->id);
    } else {
        $authUser->following()->attach($user->id);
    }

    return back();
}

}
