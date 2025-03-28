<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\FcmService;
use Auth;
use Illuminate\Http\Request;

class SaveFcmTokenController extends Controller
{
    public function __construct(protected FcmService $fcmService)
    {
    }
    public function saveFcmToken(Request $request)
    {

        $this->fcmService->saveToken($request);

        return response()->json(['message' => 'Token saved']);

    }
}
