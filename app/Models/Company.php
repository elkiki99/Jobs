<?php

namespace App\Models;

use App\Models\Opening;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'city',
        'postcode',
        'phone',
        'industry',
        'founded',
        'logo',
        'bio',
        'website',
        'country',
        'employees',
        'revenue',
        'slug',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function openings()
    {
        return $this->hasManyThrough(Opening::class, User::class);
    }
}
