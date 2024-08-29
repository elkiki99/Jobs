<?php

namespace App\Models;

use App\Models\Opening;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function opening()
    {
        return $this->hasMany(Opening::class);
    }
}
