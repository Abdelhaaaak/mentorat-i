<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; 

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'expertise',
        'bio',
        'profile_image',
    ];

    // ... tes relations ...





    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function mentorSessions()
    {
        return $this->hasMany(Session::class, 'mentor_id');
    }

    public function studentSessions()
    {
        return $this->hasMany(Session::class, 'student_id');
    }
    public function skills()
{
    return $this->belongsToMany(Skill::class, 'profile_skills', 'user_id', 'skill_id');
}
// User model (App\Models\User)

public function followers()
{
    return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
}

public function following()
{
    return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
}

public function mentor()
{
    return $this->hasOne(Mentor::class);
}

public function mentee()
{
    return $this->hasOne(Mentee::class);
}

}
