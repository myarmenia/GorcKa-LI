<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserProfileController extends Controller
{
    public function index(Request $request){
        return Inertia::render('Profile/Index',[
            // 'locale'=> app()->getLocale()
        ]);
    }
}
