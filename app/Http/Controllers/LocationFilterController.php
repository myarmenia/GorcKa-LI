<?php

namespace App\Http\Controllers;

use App\Services\LocationFilterService;

class LocationFilterController extends Controller
{
    public function __invoke($value)
    {

        $result = LocationFilterService::filter( $value);

        return response()->json($result);
    }
}
