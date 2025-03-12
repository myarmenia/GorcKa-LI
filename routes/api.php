<?php

use App\Http\Controllers\User\Profile\UpdateProfileAvatarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::post('update-profile-avatar', UpdateProfileAvatarController::class)->name('update-profile-avatar');
});
