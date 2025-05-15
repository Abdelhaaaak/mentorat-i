<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mentor;
use App\Models\Mentee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return redirect()->route('register.mentee');
    }

    public function store(Request $request)
    {
        return $this->storeMentee($request);
    }

    // 👉 MENTEE
    public function showMentee()
    {
        return view('auth.register-mentee');
    }

    public function storeMentee(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'interests' => 'nullable|string',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'mentee',
        ]);

        Mentee::create([
            'user_id'   => $user->id,
            'interests' => $request->interests,
        ]);

        Auth::login($user);
        return redirect()->route('mentee.dashboard');
    }

    // 👉 MENTOR
    public function showMentor()
    {
        return view('auth.register-mentor');
    }

    public function storeMentor(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|string|confirmed|min:8',
            'expertise' => 'required|string|max:255',
            'bio'       => 'nullable|string',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'mentor',
        ]);

        Mentor::create([
            'user_id'   => $user->id,
            'expertise' => $request->expertise,
            'bio'       => $request->bio,
        ]);

        Auth::login($user);
        return redirect()->route('mentor.dashboard');
    }
}
