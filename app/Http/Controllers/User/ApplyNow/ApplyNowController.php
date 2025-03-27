<?php

namespace App\Http\Controllers\User\ApplyNow;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Services\FcmService;
use App\Services\User\ApplyNowService;
use Auth;
use Illuminate\Http\Request;

class ApplyNowController extends Controller
{

    public function __construct(protected ApplyNowService $applyNowService)
    {
    }
    public function applyNow(Request $request, $locale, Task $task)
    {

        $this->applyNowService->applyNow($task);
        return redirect()->back()->with('success', 'Notification sent');
        // return response()->json(['message' => 'Notification sent']);
        // return response()->json(['message' => 'User not found'], 404);

    }
}
