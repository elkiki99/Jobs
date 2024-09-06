
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\DevMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OpeningController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\RecruiterMiddleware;

Route::get('/', function () {
    return view('home');
})->name('home');

/**
 * Profile
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
}); 

Route::get('/cv', [ProfileController::class, 'cv'])->middleware(DevMiddleware::class)->name('profile.cv');

/**
 * Openings
 */
Route::get('/openings', [OpeningController::class, 'index'])->name('openings.index');
Route::get('/opening/create', [OpeningController::class, 'create'])->name('openings.create');
Route::post('/opening/create', [OpeningController::class, 'store'])->name('openings.store');
Route::get('/opening/edit/{slug}', [OpeningController::class, 'edit'])->name('openings.edit');
Route::post('/opening/edit/{slug}', [OpeningController::class, 'update'])->name('openings.update');
Route::get('/opening/{slug}', [OpeningController::class, 'show'])->name('openings.show');
Route::get('/applications', [OpeningController::class, 'applications'])->middleware(DevMiddleware::class)->name('openings.applications');
Route::get('/my-openings', [OpeningController::class, 'myOpenings'])->middleware(RecruiterMiddleware::class)->name('openings.my-openings');
Route::post('/opening/{slug}', [OpeningController::class, 'apply'])->name('openings.show');

/**
 * Users
 */
Route::get('/connect', [UserController::class, 'index'])->name('users.index');
Route::get('/user/{username}', [UserController::class, 'show'])->name('users.show');
Route::get('/network', [UserController::class, 'network'])->name('network');
Route::get('/followers', [UserController::class, 'followers'])->name('users.followers');
Route::get('/following', [UserController::class, 'following'])->name('users.following');

/**
 * Company
 */
Route::get('/company/{slug}', [CompanyController::class, 'show'])->name('companies.show');

/**
 * Category
 */
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('/contact', function() {
    return view('contact');
})->name('contact');

Route::get('/search', function() {
    return view('search');
})->name('search');

Route::get('/about', function() {
    return view('about');
})->name('about');

Route::get('/terms', function() {
    return view('terms');
})->name('terms');

Route::get('/support', function() {
    return view('support');
})->name('support');

Route::get('/privacy', function() {
    return view('privacy');
})->name('privacy');

Route::get('/cookies', function() {
    return view('cookies');
})->name('cookies');

Route::get('/help', function() {
    return view('help');
})->name('help');

require __DIR__.'/auth.php';
