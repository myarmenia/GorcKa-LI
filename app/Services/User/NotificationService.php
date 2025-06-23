<?php
namespace App\Services\User;


use App\Helpers\Helper;
use App\Interfaces\User\UserInterface;
use App\Models\User;
use App\Services\FileUploadService;
use Auth;
use Illuminate\Support\Facades\Storage;

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


}
