<?php

use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });


Broadcast::channel('notification-count.{userId}', function ($user, $userId) {

    return (int) $user->id === (int) $userId ? $user : null;
    // return (int) $user->id === (int) $userId;
});

