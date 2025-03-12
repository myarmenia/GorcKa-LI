<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function __invoke()
    {

        $categories = Helper::getCategories();


        return Inertia::render('Welcome', ['categories' => $categories]);
    }

}
