<?php

namespace App\Http\Controllers;

use App\Models\Opening;
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
        return view('openings.create');
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(Request $request)
    {
        $opening = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:10000'],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'salary' => ['required', 'numeric'],
            'location' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:open,closed'],
            'slug' => ['required', 'string', 'max:255', 'unique:openings'],	
            'category_id' => ['required', 'exists:categories,id'],
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
    public function show($slug)
    {
        $opening = Opening::with(['user', 'user.company', 'category'])->where('slug', $slug)->firstOrFail();

        return view('openings.show', [
            'opening' => $opening,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $opening = Opening::where('slug', $slug)->firstOrFail();
        Gate::authorize('update', $opening);

        return view('openings.edit', [
            'opening' => $opening,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $opening = Opening::where('slug', $slug)->firstOrFail();
        Gate::authorize('update', $opening);

        $newOpening = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:10000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'salary' => ['required', 'numeric'],
            'location' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:open,closed'],
            'slug' => [
                        'required', 
                        'string', 
                        'max:255',
                        Rule::unique('openings')->ignore($opening->id),
                    ],            
            'category_id' => ['required', 'exists:categories,id'],
        ]);
        

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('openings', 'public');
            $newOpening['image'] = $imagePath;
        } else {
            $newOpening['image'] = $opening->image;
        }
        $opening->update($newOpening);

        return redirect()->route('openings.my-openings')->with('opening_updated', 'Opening updated successfully!');

        return view('openings.edit', [
            'opening' => $opening,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $opening = Opening::with(['user', 'user.company', 'category'])->where('slug', $slug)->firstOrFail();
        $opening->delete();
        return redirect()->route('openings.my-openings')->with('opening_deleted', 'Opening deleted successfully!');

        return view('openings.delete', [
            'opening' => $opening
        ]);
    }
    
    public function apply($slug)
    {
        $opening = Opening::where('slug', $slug)->firstOrFail();
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
