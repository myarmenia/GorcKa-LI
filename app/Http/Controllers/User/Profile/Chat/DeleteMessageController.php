<?php

namespace App\Http\Controllers\User\Profile\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteMessageController extends MessageController
{
    public function __invoke(Request $request)
    {

        $this->messagesService->deleteMessages($request->id);
    }
}
