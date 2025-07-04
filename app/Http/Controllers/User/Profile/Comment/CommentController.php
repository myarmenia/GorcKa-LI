<?php

namespace App\Http\Controllers\User\Profile\Comment;

use App\DTO\Comment\CommentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CommentRequest;
use App\Services\User\Comments\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function __construct(protected CommentService $commentService)
    {
    }

    public function index(){

        $comments = $this->commentService->getComments()->paginate(3);

        return Inertia::render('Profile/Comments/CommentPage', [
                        'comments' => $comments
                ]);
    }



    public function sendComment(CommentRequest $request){

        try {
            $result = $this->commentService->storeComment(CommentDTO::fromCommentDTO($request));

            if (!$result) {

                return response()->json(['message' => 'Не удалось сохранить комментарий. Возможно, вы уже оставили комментарий ранее.'], 404);
            }

            return response()->json(['message' => 'Комментарий сохранён.']);

        } catch (\Throwable $e) {
            Log::error('Ошибка при сохранении комментария: ' . $e->getMessage());
            return response()->json(['message' => 'Произошла внутренняя ошибка.']);

        }
    }
}
