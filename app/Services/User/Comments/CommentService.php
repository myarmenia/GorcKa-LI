<?php
namespace App\Services\User\Comments;


use App\Interfaces\User\UserInterface;
use Auth;

class CommentService
{
    public function __construct(protected UserInterface $userRepository)
    {
    }


    public function getUserNotifications()
    {
        $user = Auth::user();

        return $user->notifications()
            ->with('task:id,title')
            ->orderBy('id', 'desc');
        // ->get();

    }


    public function deleteAllNotifications()
    {
        return auth()->user()->notifications()->delete();

    }


}
