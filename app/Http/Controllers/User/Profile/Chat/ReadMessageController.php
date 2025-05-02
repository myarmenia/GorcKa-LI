<?php

namespace App\Http\Controllers\User\Profile\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReadMessageController extends MessageController
{

    public function __invoke($locale, $roomId, $userId)
    {

        $read = $this->messagesService->readMessages($roomId, $userId);
        // dd($messages);
        // return response()->json(['messages' => $messages]);

    }
}
