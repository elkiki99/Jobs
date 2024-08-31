<?php

namespace App\Http\Controllers;

use App\Models\Opening;
use Illuminate\Http\Request;

class OpeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $openings = Opening::latest()->paginate(24);

        return view('openings.index', [
            'openings' => $openings,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Opening $opening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Opening $opening)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Opening $opening)
    {
        //
    }
}
