<?php

use Inertia\Inertia;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Specialist\SpecialistController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return redirect('/am');
});


Route::prefix('{locale}')
    ->where(['locale' => 'en|ru|am']) // Разрешенные языки
    ->group(function () {

        Route::get('/', function () {
            return Inertia::render('Welcome', [
                'locale' => app()->getLocale(), // Локаль теперь берется из Middleware
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => Application::VERSION,
                'phpVersion' => PHP_VERSION,
            ]);
        })->name('welcome');

        Route::get('dashboard', function () {
            return Inertia::render('Dashboard');
        })->middleware(['auth', 'verified_with_locale'])->name('dashboard');

        Route::get('specialists', SpecialistController::class)->name('user.specialists');
    });


Route::get('/admin', function () {
    return Inertia::render('WelcomeAdmin');
});


// Route::get('/filter-locations', function () {
//     return response()->json(Helper::filterLocations());
// });


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
