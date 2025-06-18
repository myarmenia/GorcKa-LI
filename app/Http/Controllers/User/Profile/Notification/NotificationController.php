<?php

namespace App\Http\Controllers\User\Profile\Notification;

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

        // $locations = Helper::getLocations();
        // $langs = Helper::getLanguages();
        // $categories = Helper::getCategoriesWithSubCategories();
        // $socialMedias = Helper::socialMedias();

        // $user = $this->profileService->getUser();
        $notifications = $this->notificationService->getUserNotifications();

        return Inertia::render('Profile/Notifications/NotificationPage', [
                        'notifications' => $notifications
                ]);

    }

}
