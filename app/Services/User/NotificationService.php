<?php
namespace App\Services\User;


use App\Events\NotificationEvent;
use App\Interfaces\User\UserInterface;
use Auth;

class NotificationService
{
    public function __construct(protected UserInterface $userRepository)
    {
    }


    public function getUserNotifications()
    {
        $user = Auth::user();

        return  $user->notifications()
            ->with('task:id,title')
            ->orderBy('id', 'desc');
            // ->get();

    }


    public function deleteAllNotifications(){
        return auth()->user()->notifications()->delete();

    }

    public function readNotificationsInPage($data){

        $user = Auth::user();

        $read = $user->notifications()->whereIn('id', $data['ids'])->update(['read_at' => now()]);

        event(new NotificationEvent(
            $user->notifications()->unread()->count(),
            $user->id
        ));

        return $read;

    }


}
