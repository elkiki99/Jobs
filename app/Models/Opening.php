<?php

namespace App\Models;

use App\Models\User;
use App\Models\Company;
// use App\Models\Opening;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opening extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'location',
        'image',
        'salary',
        // 'status',
        'slug',
        'company_id',
        'category_slug',
        'user_id',
    ];

    public function category()
    {
        return Category::findBySlug($this->category_slug);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applicants()
    {
        return $this->belongsToMany(User::class, 'opening_user', 'opening_id', 'user_id');
    }
}
