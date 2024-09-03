<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCv extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_summary',
        'education',
        'work_experience',
        'skills',
        'certifications',
        'languages',
        'interests',
    ];

    protected $casts = [
        'education' => 'array',
        'work_experience' => 'array',
        'skills' => 'array',
        'certifications' => 'array',
        'languages' => 'array',
        'interests' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}