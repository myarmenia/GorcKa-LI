<?php

namespace App\Http\Controllers\User\Profile\Comment;

use App\DTO\Comment\CommentDTO;
use App\Http\Controllers\Controller;
use App\Services\User\Comments\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(protected CommentService $commentService)
    {
    }
    public function sendComment(Request $request){
        // dd($request->all());

        $addComment = $this->commentService->storeComment(CommentDTO::fromCommentDTO($request));

        // return Inertia::render('Profile/Notifications/NotificationPage', [
        //     'notifications' => $notifications
        // ]);
    }
}
