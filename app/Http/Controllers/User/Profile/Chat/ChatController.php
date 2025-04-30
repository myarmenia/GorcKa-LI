<?php

namespace App\Http\Controllers\User\Profile\Chat;

use App\Http\Controllers\Controller;
use App\Services\Chat\ChatService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChatController extends Controller
{
    public function __construct(protected ChatService $chatService)
    {
    }
    public function __invoke(){

        $rooms = $this->chatService->getRoomsWithApplicants();
        return Inertia::render('Profile/Chat/Chat',['rooms' => $rooms]);
    }
}
