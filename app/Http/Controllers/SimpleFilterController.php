<?php

namespace App\Http\Controllers;


use App\Services\FilterService;

class SimpleFilterController extends Controller
{

    public function __invoke($model, $value){

        $result = FilterService::filter($model, $value, 'scopeSimpleFilter');

        return response()->json($result);
    }
}
