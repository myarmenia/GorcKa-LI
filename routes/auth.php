<?php

use App\Http\Controllers\User\ApplyNow\ApplyNowController;
use App\Http\Controllers\User\Profile\Chat\ChatController;
use App\Http\Controllers\User\Profile\Chat\DeleteMessageController;
use App\Http\Controllers\User\Profile\Chat\DeleteRoomController;
use App\Http\Controllers\User\Profile\Chat\GetMessagesController;
use App\Http\Controllers\User\Profile\Chat\ReadMessageController;
use App\Http\Controllers\User\Profile\Chat\SelectExecutorController;
use App\Http\Controllers\User\Profile\Chat\SendMessageController;
use App\Http\Controllers\User\Profile\Comment\CommentController;
use App\Http\Controllers\User\Profile\Notification\NotificationController;
use App\Http\Controllers\User\Profile\UserProfileController;
use App\Http\Controllers\User\SaveFcmTokenController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\User\Profile\TaskController;
use App\Http\Controllers\User\Profile\UpdateProfileAvatarController;

// Route::middleware('setLocale')->prefix('{locale}')->where(['locale' => 'en|ru|am'])->group(function () {
Route::prefix('{locale}')
    ->where(['locale' => 'en|ru|am']) // Здесь указываются допустимые значения для локали
    ->group(function () {

        Route::middleware('my_guest')->group(function () {

            Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

            Route::post('register', [RegisteredUserController::class, 'store']);

            Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

            Route::post('login', [AuthenticatedSessionController::class, 'store']);

            Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

            Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

            Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

            Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');

            Route::get('/profile_page', [ProfileController::class, 'profile_page'])->name('profile.profile_page');

            Route::post('update-profile-avatar', UpdateProfileAvatarController::class)->name('update-profile-avatar');

        });
    });


Route::middleware('auth')->group(function () {

    Route::prefix('{locale}')
        ->where(['locale' => 'en|ru|am']) // Здесь указываются допустимые значения для локали
        ->group(function () {

            Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice')->where(['locale' => 'en|ru|am']);

            Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

            Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['throttle:6,1'])
                ->name('verification.send');

            Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

            Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

            Route::put('password', [PasswordController::class, 'update'])->name('password.update');

            // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            // Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

            Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');

            // Route::resource('roles', RoleController::class);

            Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

            Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile');
            Route::post('/profile', [UserProfileController::class, 'update'])->name('user.profile.update');
            Route::post('/submit-subcategories', [UserProfileController::class, 'executor_sub_categories'])->name('user.executor_sub_categories');
            Route::post('/profile/password', [UserProfileController::class, 'update_password'])->name('profile.password.update');

            Route::prefix('notifications')->group(function () {
                Route::get('/', [NotificationController::class, 'index'])->name('user.notifications');
                Route::get('/delete_all', [NotificationController::class, 'deleteAll'])->name('user.notifications.delete_all');
                Route::post('/read', [NotificationController::class, 'read'])->name('user.notifications.read');

            });

            Route::prefix('comments')->group(function () {
                Route::get('/', [CommentController::class, 'index'])->name('user.comments');
            });

            Route::post('/comment-mark', [CommentController::class, 'sendComment'])->name('user.comment_mark');

            // Route::get('task-index',[TaskController::class,'create'])->name('task.create');
            Route::prefix('task')->group(function () {

                Route::get('/list', [TaskController::class, 'index'])->name('task.list');
                Route::get('/create', [TaskController::class, 'create'])->name('task.create');
                Route::post('/list', [TaskController::class, 'store'])->name('task.store');
                Route::get('{id}/edit', [TaskController::class, 'edit'])->name('task.edit');
                // when make updateing file dont go it work only
                Route::post('/{id}', [TaskController::class, 'update'])->name('task.update');


            });


            Route::prefix('chat')->group(function () {

                Route::get('/', [ChatController::class, 'index'])->name('user.chat');
                Route::get('/search', [ChatController::class, 'search'])->name('user.chat.search');
                Route::get('/messages/{room_id}', GetMessagesController::class)->name('user.chat.messages');
                // Route::get('/messages/{room_id}', GetMessagesController::class)->name('user.chat.messages');
                Route::get('/messages/{romm_id}/{user_id}/read', ReadMessageController::class)->name('user.chat.messages');
                Route::post('/messages/send', SendMessageController::class)->name('user.chat.send_message');
                Route::get('/messages/{id}/delete', DeleteMessageController::class)->name('user.chat.delete_message');
                Route::get('/room/{id}/delete', DeleteRoomController::class)->name('user.chat.delete_room');
                Route::get('/select-executor/{id}/room', SelectExecutorController::class)->name('user.chat.select-executor');


            });


            Route::post('/apply-now/{task}', [ApplyNowController::class, 'applyNow'])->name('apply_now');
            Broadcast::routes(['middleware' => ['auth']]);

        });



    Route::post('/save-fcm-token', [SaveFcmTokenController::class, 'saveFcmToken']);

});
// Route::post('/save-fcm-token', [ApplyNowController::class, 'sendPush']);

// Route::resource('roles', RoleController::class);




