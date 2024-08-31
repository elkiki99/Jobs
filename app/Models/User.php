<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Opening;
use App\Models\Follower;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'role',
        'avatar',
        'bio',
        'phone',
        'address',
        'city',
        'country',
        'postcode',
        'gender',
        'company_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function opening()
    {
        return $this->hasMany(Opening::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function appliedOpenings()
    {
        return $this->belongsToMany(Opening::class, 'opening_user', 'user_id', 'opening_id');
    }

    public function following()
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function follower()
    {
        return $this->hasMany(Follower::class, 'followed_id');
    }
}
