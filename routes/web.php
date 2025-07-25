<?php


use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DeleteItemController;
use App\Http\Controllers\CategoryWithSubCategoryFilterController;
use App\Http\Controllers\LocationFilterController;
use App\Http\Controllers\SimpleFilterController;
use App\Http\Controllers\User\Categories\CategoriesController;
use App\Http\Controllers\User\Jobs\JobsController;
use App\Http\Controllers\User\Jobs\SingleJobeController;
use App\Http\Controllers\WelcomeController;
use App\Services\FileUploadService;
use Inertia\Inertia;
use App\Helpers\Helper;
use App\Http\Controllers\Contact\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Specialist\SpecialistController;
use App\Http\Controllers\Specialist\SpecialistDetailsController;
use App\Models\Task;

Route::get('/', function () {
    return redirect('/am');
});


Route::prefix('{locale}')
    ->where(['locale' => 'en|ru|am']) // Разрешенные языки
    ->group(function () {

        Route::get('/', WelcomeController::class)->name('welcome');

        Route::get('dashboard', function () {
            return Inertia::render('Dashboard');
        })->middleware(['auth', 'verified_with_locale'])->name('dashboard');

        Route::get('specialists', [SpecialistController::class, 'index'])->name('specialists');
        Route::get('categories', CategoriesController::class)->name('categories');
        Route::get('jobs', JobsController::class)->name('jobs');
        Route::get('single-jobe/{id}', SingleJobeController::class)->name('single_job');
        // Route::get('job/{sub_category}/{slug}', SingleJobeController::class)->name('single_job');
        Route::get('specialist/{specialist}',[SpecialistDetailsController::class,'index'])->name('specialist_details');
        Route::get('contact',[ContactController::class,'index'])->name('contact');
        Route::post('contact',[ContactController::class,'store'])->name('contact.store');

    });


Route::get('/admin', function () {
    return Inertia::render('WelcomeAdmin');
});

Route::get('get-file', [FileUploadService::class, 'get_file'])->name('get-file');
Route::delete('delete-item/{tb_name}/{id}', [DeleteItemController::class, 'index'])->name('delete_item');


Route::get('/location-filter/{value}', LocationFilterController::class)->name('location_filter');
Route::get('/category-subcategory-filter/{value}', CategoryWithSubCategoryFilterController::class)->name('category_subcategory_filter');




require __DIR__.'/auth.php';
