<?php

// namespace App\Http\Controllers;

// use App\Models\Category;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Gate;

// class CategoryController extends Controller
// {
//     /**
//      * Display the specified resource.
//      */
//     public function show($slug)
//     {
//         $category = Category::with('opening')->where('slug', $slug)->firstOrFail();
//         $openings = $category->opening()->paginate(24);

//         return view('categories.show', [
//             'category' => $category,
//             'openings' => $openings
//         ]);
//     }
// }
