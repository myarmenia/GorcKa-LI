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
        // dd($user->notifications);

        return $user->notifications;

    }


}
