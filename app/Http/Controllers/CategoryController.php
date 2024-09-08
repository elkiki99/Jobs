<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Category::class);
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'slug' => ['required', 'string', 'max:255', 'unique:categories'],	
        ]);

        Category::create($category);
        return redirect()->route('openings.my-openings')->with('category_created', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $category = Category::with('opening')->where('slug', $slug)->firstOrFail();
        $openings = $category->opening()->paginate(24);

        return view('categories.show', [
            'category' => $category,
            'openings' => $openings
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        Gate::authorize('edit', Category::class);
        return view('categories.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
