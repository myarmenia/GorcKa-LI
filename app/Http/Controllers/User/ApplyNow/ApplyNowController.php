<?php

namespace App\Http\Controllers\User\ApplyNow;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Services\FcmService;
use App\Services\User\ApplyNowService;
use App\Services\User\Notify\NotifyService;
use Auth;
use Illuminate\Http\Request;

class ApplyNowController extends Controller
{

    public function __construct(protected NotifyService $notifyService)
    {
    }
    public function applyNow(Request $request, $locale, Task $task)
    {
        $result = $this->notifyService->applyNow($task);

        if (!$result['success']) {
            return response()->json(['error' => $result['message']], 403);
        }

        return response()->json(['message' => $result['message']]);

    }
}
