<?php

namespace App\Http\Controllers\Specialist;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\Specialist\SpecialistService;
use App\Traits\Paginator;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SpecialistController extends Controller
{
    use Paginator;
    public function __construct(protected SpecialistService $specialistService)
    {
    }


    public function index(Request $request){
        // $page = request()->page ?? 1;
        $perPage = 1;

        $locations = Helper::getLocations();
        $categories = Helper::getCategories();
        // $specialists = $this->specialistService->getAll();
        $specialists = $this->specialistService->filterSpecialists($request->all());
        $specialists = $this->arrayPaginator($specialists, $request, $perPage);

        return Inertia::render('Specialists/Index', ['locations' => $locations, 'categories' => $categories, 'specialists' => $specialists, "locale" => app()->getLocale()]);
    }

    // public function filter(Request $request)
    // {
    //     // $page = request()->page ?? 1;
    //     $perPage = 1;

    //     $specialists = $this->specialistService->filterSpecialists($request->all());
    //     $specialists = $this->arrayPaginator($specialists, $request, $perPage);

    //     return Inertia::render('Specialists/Index', ['specialists' => $specialists]);

    // }
}
