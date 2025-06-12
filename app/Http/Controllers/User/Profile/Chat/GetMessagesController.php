<?php

namespace App\Http\Controllers\User\Profile\Chat;

use App\Http\Controllers\Controller;
use App\Services\Chat\MessagesService;
use Illuminate\Http\Request;

class GetMessagesController extends MessageController
{

    public function __invoke($locale, $roomId){


        $messages = $this->messagesService->getRoomMessages($roomId);
        // dd($messages);
        return response()->json(['messages' => $messages]);

    }
}
