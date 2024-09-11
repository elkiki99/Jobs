<?php

namespace App\Http\Controllers;

use App\Models\Opening;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class OpeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $openings = Opening::with('user.company')->latest()->paginate(24);

        return view('openings.index', [
            'openings' => $openings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Opening::class);
        $countries = config('countries');
        $categories = config('categories');
        
        return view('openings.create', [
            'countries' => $countries,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(Request $request)
    {   
        $categorySlugs = array_column(config('categories'), 'slug');

        $opening = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:10000'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'salary' => ['required', 'numeric'],
            'location' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:openings'],	
            'company_id' => ['required', 'exists:companies,id'],
            'category_slug' => ['required', 'string', Rule::in($categorySlugs)],
        ], [
            'category_slug.required' => 'The category field is required.',
            'category_slug.string' => 'The category must be a string.',
            'category_slug.in' => 'The selected category is invalid.',
            'company_id.required' => 'The company is required', 
            'company_id.exists' => 'The company you provided does not match our records', 
            'company_id.required' => 'The company is required', 
        ]);
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('openings', 'public');
            $opening['image'] = $imagePath;
        }
        $opening['user_id'] = auth()->user()->id;
        Opening::create($opening);

        return redirect()->route('openings.my-openings')->with('opening_created', 'Opening created successfully!');
    }

    /**
     * Display the specified resource.
     */ 
    public function show(Opening $opening)
    {
        $opening->load('user.company');

        return view('openings.show', [
            'opening' => $opening,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Opening $opening)
    {
        Gate::authorize('update', $opening);
        $countries = config('countries');
        $categories = config('categories');

        return view('openings.edit', [
            'opening' => $opening,
            'countries' => $countries,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Opening $opening)
    {
        $categorySlugs = array_column(config('categories'), 'slug');
        Gate::authorize('update', $opening);

        $newOpening = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:10000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'salary' => ['required', 'numeric'],
            'location' => ['required', 'string', 'max:255'],
            'slug' => [
                        'required', 
                        'string', 
                        'max:255',
                        Rule::unique('openings')->ignore($opening->id),
                    ],            
            'company_id' => ['required', 'exists:companies,id'],
            'category_slug' => ['required', 'string', Rule::in($categorySlugs)],
        ], [
            'category_slug.required' => 'The category field is required.',
            'category_slug.string' => 'The category must be a string.',
            'category_slug.in' => 'The selected category is invalid.',
            'company_id.required' => 'The company is required', 
            'company_id.exists' => 'The company you provided does not match our records', 
            'company_id.required' => 'The company is required', 
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('openings', 'public');
            $newOpening['image'] = $imagePath;
        } else {
            $newOpening['image'] = $opening->image;
        }
        $opening->update($newOpening);

        return redirect()->route('openings.my-openings')->with('opening_updated', 'Opening updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opening $opening)
    {
        $opening->delete();
        return redirect()->route('openings.my-openings')->with('opening_deleted', 'Opening deleted successfully!');

        return view('openings.delete', [
            'opening' => $opening
        ]);
    }

    public function indexByCategory(Category $category)
    {
        $openings = Opening::where('category_slug', $category->slug)->latest()->paginate(24);
    
        return view('openings.index', [
           'category' => $category,
           'openings' => $openings,
           'categoryName' => $category->name,
        ]);
    }
    
    public function apply(Opening $opening)
    {
        $user = auth()->user();

        if(!$user) {
            return redirect()->route('login');
        } else {
            if($user->appliedOpenings()->where('opening_id', $opening->id)->exists()) {
                return redirect()->back()->with('applied_error', 'You have already applied to this opening.');
            } else {
                $user->appliedOpenings()->attach($opening->id);
                return redirect()->back()->with('applied_success', 'Application submitted successfully.');
            }
        }
    }

    public function applications()
    {   
        $openings = auth()->user()->appliedOpenings()->paginate(24);

        return view('openings.applications', [
            'openings' => $openings,
        ]);
    }

    public function myOpenings()
    {
        $openings = auth()->user()->opening()->latest()->paginate(24);

        return view('openings.my-openings', [
            'openings' => $openings,
        ]);
    }
}
