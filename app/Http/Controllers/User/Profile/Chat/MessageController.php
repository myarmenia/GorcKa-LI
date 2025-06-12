<?php

namespace App\Http\Controllers\User\Profile\Chat;

use App\Http\Controllers\Controller;
use App\Services\Chat\MessagesService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct(protected MessagesService $messagesService)
    {
    }
}
