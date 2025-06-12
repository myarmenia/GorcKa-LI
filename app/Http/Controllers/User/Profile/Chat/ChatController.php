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
    public function index(Request $reques){

        $rooms = $this->chatService->getRoomsWithApplicants($reques);

        return Inertia::render('Profile/Chat/Chat',['rooms' => $rooms]);
    }

    public function search(Request $reques){

        $rooms = $this->chatService->getRoomsWithApplicants($reques);

        return response()->json(['rooms' => $rooms]);
    }


}
