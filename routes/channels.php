<?php

use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

// Broadcast::routes(["middleware" => ["auth"]]);
// Broadcast::routes(['middleware' => ['auth', 'locale']]);

// Broadcast::channel('notification-count.{userId}', function ($user, $userId) {

//     return (int) $userId === (int) $user->id;
// });

// Broadcast::channel('notification-count.{userId}', function ($user, $userId) {
//     dd(11);
//     return (int) $user->id === (int) $userId ? $user : null;
// });

Broadcast::channel('notification-count', function () {
    return true; // Публичный доступ, не требующий аутентификации
});

Broadcast::channel('notification-channel', function () {
    return true; // Публичный канал, доступный для всех
});


Broadcast::channel('public.channel', function () {
    return true; // Все пользователи могут подписаться
});
// Route::prefix('{locale}')
//     ->where(['locale' => 'en|ru|am'])
//     ->group(function () {

//         Broadcast::routes(['middleware' => ['auth:my_guest']]);
//         Broadcast::channel('notification-count.{userId}', function ($user, $userId) {
//             dd(11);
//             return (int) $user->id === (int) $userId ? $user : null;
//         });

// });

// Route::middleware('auth')->group(function () {

//     Route::prefix('{locale}')
//         ->where(['locale' => 'en|ru|am']) // Здесь указываются допустимые значения для локали
//         ->group(function () {
//             dd(app()->getLocale());
//             Broadcast::routes(["middleware" => ["auth"]]);

//             Broadcast::channel('chat-messages-count.{userId}', function ($user, $userId) {
//                 return (int) $user->id === (int) $userId ? $user : null;
//             });
//         });
//     });
