<?php

namespace App\Http\Controllers\User\Profile\Chat;

use App\Http\Controllers\Controller;
use App\Services\Chat\ChatService;
use Illuminate\Http\Request;

class DeleteRoomController extends MessageController
{

    public function __construct(protected ChatService $chatService)
    {
    }
    public function __invoke(Request $request)
    {

        $this->chatService->deleteRoom($request->id);
    }
}
