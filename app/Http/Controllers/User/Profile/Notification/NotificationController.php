<?php

namespace App\Http\Controllers\User\Profile\Notification;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\User\NotificationService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function __construct(protected NotificationService $notificationService)
    {
    }
    public function index(Request $request)
    {

        $notifications = $this->notificationService->getUserNotifications()->paginate(3);
        $notificationIcons = Helper::notificationIcons();

        return Inertia::render('Profile/Notifications/NotificationPage', [
                        'notifications' => $notifications,
                        'notificationIcons' => $notificationIcons
                ]);

    }


    public function deleteAll(){

        $delete = $this->notificationService->deleteAllNotifications();

        return redirect()->back();
    }


}
