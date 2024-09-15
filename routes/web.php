
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\DevMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\OpeningController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RecruiterMiddleware;
use App\Http\Controllers\LegalPagesController;
use App\Http\Controllers\NotificationController;
use App\Http\Middleware\AuthMiddleware;

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/about', function () {
    return view('about');
})->name('about');

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
Route::get('/opening/edit/{opening:slug}', [OpeningController::class, 'edit'])->name('openings.edit');
Route::post('/opening/edit/{opening:slug}', [OpeningController::class, 'update'])->name('openings.update');
Route::get('/opening/{opening:slug}', [OpeningController::class, 'show'])->name('openings.show');
Route::get('/applications', [OpeningController::class, 'applications'])->middleware(DevMiddleware::class)->name('openings.applications');
Route::get('/my-openings', [OpeningController::class, 'myOpenings'])->middleware(RecruiterMiddleware::class)->name('openings.my-openings');
Route::delete('/opening/{opening:slug}', [OpeningController::class, 'destroy'])->name('openings.delete');

/**
 * Users
 */
Route::get('/connect', [UserController::class, 'index'])->name('users.index');
Route::get('/user/{user:username}', [UserController::class, 'show'])->name('users.show');
Route::get('/network', [UserController::class, 'network'])->middleware('auth')->name('network');
Route::get('/followers', [UserController::class, 'followers'])->middleware('auth')->name('users.followers');
Route::get('/following', [UserController::class, 'following'])->middleware('auth')->name('users.following');

/**
 * Company
 */
Route::get('/my-companies', [CompanyController::class, 'index'])->middleware(RecruiterMiddleware::class)->name('companies.index');
Route::get('/company/create', [CompanyController::class, 'create'])->name('companies.create');
Route::post('/company/create', [CompanyController::class, 'store'])->name('companies.store');
Route::get('/company/{company:slug}', [CompanyController::class, 'show'])->name('companies.show');
Route::get('/company/edit/{company:slug}', [CompanyController::class, 'edit'])->name('companies.edit');
Route::post('/company/edit/{company:slug}', [CompanyController::class, 'update'])->name('companies.update');
Route::delete('/company/{company:slug}', [CompanyController::class, 'destroy'])->name('companies.delete');

/**
 * Category
 */
Route::get('/openings/category/{slug}', [OpeningController::class, 'indexByCategory'])->name('categories.show');

/**
 * Legal
 */
Route::get('/cookies', [LegalPagesController::class, 'cookies'])->name('cookies');
Route::get('/contact', [LegalPagesController::class, 'contact'])->name('contact');
Route::get('/privacy', [LegalPagesController::class, 'privacy'])->name('privacy');
Route::get('/support', [LegalPagesController::class, 'support'])->name('support');
Route::get('/help', [LegalPagesController::class, 'help'])->name('help');
Route::get('/terms', [LegalPagesController::class, 'terms'])->name('terms');

/**
 * Notifications
 */
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');

require __DIR__ . '/auth.php';
