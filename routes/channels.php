<?php

use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });


Broadcast::channel('notification-count.{userId}', function ($user, $userId) {

    return (int) $user->id === (int) $userId ? $user : null;
    // return (int) $user->id === (int) $userId;
});


// Broadcast::channel('presence-user.{id}', function ($user, $id) {

//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('presence-users', function ($user) {
    return [
        'id' => $user->id,
        'name' => $user->name,
        // можешь передавать ещё данные, если нужно
    ];
});

Broadcast::channel('presence-room.{id}', function ($user, $id) {

      $user->hasAccessToRoom($id);
    //  return $user;
    return [
        'id' => $user->id,
        'name' => $user->name,
        'room_id' => (int) $id // <-- добавить это
    ];
});

Broadcast::channel('room-unread-message-count.{room_id}.{user_id}', function ($user, $room_id, $user_id) {
    return $user->hasAccessToRoom($room_id);
});


// Broadcast::channel('task-unread-message-count.{task_id}', function ($user, $task_id) {
//     return $user->hasAccessToTask($task_id);
// });
