<?php


use App\Http\Controllers\CategoryWithSubCategoryFilterController;
use App\Http\Controllers\LocationFilterController;
use App\Http\Controllers\SimpleFilterController;
use App\Services\FileUploadService;
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

        Route::get('specialists', [SpecialistController::class, 'index'])->name('user.specialists');
        Route::post('specialists', [SpecialistController::class, 'filter'])->name('user.filter_specialists');

    });


Route::get('/admin', function () {
    return Inertia::render('WelcomeAdmin');
});
Route::get('get-file', [FileUploadService::class, 'get_file'])->name('get-file');


Route::get('/location-filter/{value}', LocationFilterController::class)->name('location_filter');
Route::get('/category-subcategory-filter/{value}', CategoryWithSubCategoryFilterController::class)->name('category_subcategory_filter');




require __DIR__.'/auth.php';
