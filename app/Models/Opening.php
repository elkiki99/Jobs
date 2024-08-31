<?php

namespace App\Models;

use App\Models\User;
use App\Models\Company;
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
        'status',
        'slug',
        'category_id',
        'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
