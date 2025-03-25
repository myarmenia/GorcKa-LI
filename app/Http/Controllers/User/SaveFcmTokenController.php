<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class SaveFcmTokenController extends Controller
{
    public function saveFcmToken(Request $request)
    {
        $user = Auth::user();

        $user->fcm_token = $request->token;
        $user->save();

        return response()->json(['message' => 'Token saved']);

    }
}
