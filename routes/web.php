
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OpeningController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

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

/**
 * Openings
 */
Route::get('/openings', [OpeningController::class, 'index'])->name('openings.index');
Route::get('/opening/{slug}', [OpeningController::class, 'show'])->name('openings.show');
Route::post('/opening/{slug}', [OpeningController::class, 'apply'])->name('openings.show');

/**
 * Users
 */
Route::get('/network', [UserController::class, 'index'])->name('users.index');
Route::get('/user/{username}', [UserController::class, 'show'])->name('users.show');

/**
 * Company
 */
Route::get('/company/{slug}', [CompanyController::class, 'show'])->name('companies.show');

/**
 * Category
 */
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');

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
