<?php

namespace App\Http\Controllers\User\Profile\Chat;

use App\DTO\Chat\MessageDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\SendMessageRequest;

use App\Services\Chat\MessagesService;
use Illuminate\Http\Request;

class SendMessageController extends MessageController
{

    public function __invoke(SendMessageRequest $request){
        // dd($request->all());
        $this->messagesService->storeMessage(MessageDTO::fromMessageDTO((object) $request->all()));

    }
}
