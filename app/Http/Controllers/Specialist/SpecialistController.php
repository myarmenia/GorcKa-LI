<?php

namespace App\Http\Controllers\Specialist;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\Specialist\SpecialistService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SpecialistController extends Controller
{
    public function __construct(protected SpecialistService $specialistService)
    {
    }


    public function index(){

        $locations = Helper::getLocations();
        $categories = Helper::getCategories();
        $specialists = $this->specialistService->getAll();

        return Inertia::render('Specialists/Index', ['locations' => $locations, 'categories' => $categories, 'specialists' => $specialists]);
    }

    public function filter(Request $request)
    {

        dd($request->all());
    }
}
