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
        'certifications',
        'languages',
        'interests',
        'projects',
        'skills',
    ];

    protected $casts = [
        'education' => 'array',
        'work_experience' => 'array',
        'skills' => 'array',
        'certifications' => 'array',
        'languages' => 'array',
        'interests' => 'array',
        'projects' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}