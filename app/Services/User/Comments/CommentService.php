<?php
namespace App\Services\User\Comments;


use App\Interfaces\User\UserInterface;
use Auth;

class CommentService
{
    public function __construct(protected UserInterface $userRepository)
    {
    }


    public function storeComment($data)
    {
        dd($data);
        $user = Auth::user();

        return $user->notifications()
            ->with('task:id,title')
            ->orderBy('id', 'desc');
        // ->get();

    }




}
