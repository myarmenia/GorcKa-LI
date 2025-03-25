<?php

namespace App\Http\Controllers\User\ApplyNow;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FcmService;
use Auth;
use Illuminate\Http\Request;

class ApplyNowController extends Controller
{

    public function __construct(protected FcmService $fcmService)
    {
    }
    public function sendPush(Request $request)
    {
        // $user = Auth::user();
        // // dd($request->token);
        // $user->fcm_token = $request->token;
        //     $user->save();
        //     return response()->json(['message' => 'Token saved']);



        $user = User::findOrFail(2);
// dd($user);
        // Отправляем уведомление

        if ($user) {
            // Отправка уведомления
            $title = "Заголовок уведомления";
            $body = "Текст уведомления";

            $this->fcmService->sendNotification($user, $title, $body);

            return response()->json(['message' => 'Notification sent']);
        }

        return response()->json(['message' => 'User not found'], 404);

    }
}
