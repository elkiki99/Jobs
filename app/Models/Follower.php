<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Follower extends Model
{
    use HasFactory;

    protected $fillable = [
        'follower_id',
        'followed_id',
    ];

    public function follower()
    {
        return $this->belongsTo(User::class, 'follower_id');
    }
    
    public function followed()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }
    
}
