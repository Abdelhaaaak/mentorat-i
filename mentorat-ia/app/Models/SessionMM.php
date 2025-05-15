<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionMM extends Model
{
    protected $table = 'mentor_sessions';

    protected $fillable = [
        'mentor_id',
        'mentee_id',
        'scheduled_at',
        'status',
        'notes',
    ];
    protected $casts = [
    'scheduled_at' => 'datetime',
];


    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function mentee()
    {
        return $this->belongsTo(User::class, 'mentee_id');
    }
    
}
