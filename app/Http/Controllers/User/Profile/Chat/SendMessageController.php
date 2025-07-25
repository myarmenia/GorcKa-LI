<?php

namespace App\Http\Controllers\User\Profile\Chat;

use App\DTO\Chat\MessageDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\SendMessageRequest;

use App\Services\Chat\MessagesService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class SendMessageController extends MessageController
{

    public function __invoke(SendMessageRequest $request)
    {
        // dd($request->all());
        // $this->messagesService->storeMessage(MessageDTO::fromMessageDTO((object) $request->all()));


        try {
            $result = $this->messagesService->storeMessage(
                MessageDTO::fromMessageDTO((object) $request->all())
            );

            if (!$result) {

                return redirect()->back()->withErrors([
                    'message' => 'Ошибка при отправке сообщения',
                ]);
            }

            return redirect()->back();
            

        } catch (Throwable $e) {

            return redirect()->back()->withErrors([
                'message' => $e->getMessage() ?? 'Произошла ошибка',
            ]);
        }
    }
}
