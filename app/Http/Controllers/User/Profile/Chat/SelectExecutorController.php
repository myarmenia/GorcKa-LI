<?php

namespace App\Http\Controllers\User\Profile\Chat;

use App\Http\Controllers\Controller;
use App\Services\Chat\ChatService;
use App\Services\User\Notify\NotifyService;
use Illuminate\Http\Request;

class SelectExecutorController extends Controller
{
    public function __construct(protected NotifyService $notifyService)
    {
    }

    public function __invoke(Request $request)
    {

        $this->notifyService->selectExecutor($request->id);
    }
}

