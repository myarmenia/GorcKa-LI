<?php

namespace App\Http\Controllers\Specialist;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SpecialistController extends Controller
{
    public function __invoke(){

        $locations = Helper::getLocations();

        return Inertia::render('Specialists/Index', ['locations' => $locations]);
    }
}
