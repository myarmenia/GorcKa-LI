<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UpdateProfileAvatarController extends Controller
{
    public function __invoke(Request $request){
        dd($request->all());

    }
}
