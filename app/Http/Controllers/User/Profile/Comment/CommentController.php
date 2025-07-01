<?php

namespace App\Http\Controllers\User\Profile\Comment;

use App\DTO\Comment\CommentDTO;
use App\Http\Controllers\Controller;
use App\Services\User\Comments\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    public function __construct(protected CommentService $commentService)
    {
    }
    public function sendComment(Request $request){

        try {
            $result = $this->commentService->storeComment(CommentDTO::fromCommentDTO($request));

            if (!$result) {

                return back()->with('error', 'Не удалось сохранить комментарий.');
            }

            return back()->with('success', 'Комментарий сохранён.');
        } catch (\Throwable $e) {
            Log::error('Ошибка при сохранении комментария: ' . $e->getMessage());
            return back()->with('error', 'Произошла внутренняя ошибка.');

        }
    }
}
