<?php

namespace App\Http\Controllers\User\Profile\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function sendComment(Request $request){
        dd($request->all());
    }
}
