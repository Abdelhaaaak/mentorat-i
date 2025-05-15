<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the authenticated user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        // Turn skills pivot into comma list for the input
        $skills = $user->skills()->pluck('name')->implode(', ');
        return view('profile.edit', compact('user','skills'));
    }

    /**
     * Update the authenticated user's profile in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,'. $user->id,
            'expertise'      => 'nullable|string|max:255',
            'skills'         => 'nullable|string',        // comma-separated
            'bio'            => 'nullable|string',
            'profile_image'  => 'nullable|image|max:2048', // max 2MB
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            // Store new one
            $path = $request->file('profile_image')->store('profiles', 'public');
            $data['profile_image'] = $path;
        }

        // Update user fields
        $user->fill($data);
        $user->save();

        // Sync skills pivot (assuming Skill model exists)
        if (isset($data['skills'])) {
            $names = array_filter(array_map('trim', explode(',', $data['skills'])));
            // Find or create each skill, then sync IDs
            $skillIds = \App\Models\Skill::whereIn('name',$names)
                          ->pluck('id')
                          ->toArray();

            // create missing ones
            $new = array_diff($names, \App\Models\Skill::whereIn('name',$names)->pluck('name')->toArray());
            foreach ($new as $name) {
                $skillIds[] = \App\Models\Skill::create(['name'=>$name])->id;
            }

            $user->skills()->sync($skillIds);
        }

        return redirect()->route('profile.show', $user)
                         ->with('success', 'Profile updated successfully.');
    }
}
