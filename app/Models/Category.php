<?php

namespace App\Models;

class Category
{
    public $id;
    public $name;
    public $slug;
    public $description;

    public function __construct($id, $name, $slug, $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
    }

    public static function all()
    {
        return collect(config('categories'))->map(function ($category) {
            return new self($category['id'], $category['name'], $category['slug'], $category['description']);
        });
    }

    public static function findBySlug($slug)
    {
        return self::all()->firstWhere('slug', $slug);
    }

        public function openings()
    {
        return $this->hasMany(Opening::class);
    }
}