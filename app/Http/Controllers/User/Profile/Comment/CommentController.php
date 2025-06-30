<?php

namespace App\Http\Controllers\User\Profile\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // public function __construct(protected NotificationService $notificationService)
    // {
    // }
    public function sendComment(Request $request){
        dd($request->all());

        // $addComment = $this->notificationService->getUserNotifications()->paginate(1);

        // return Inertia::render('Profile/Notifications/NotificationPage', [
        //     'notifications' => $notifications
        // ]);
    }
}
