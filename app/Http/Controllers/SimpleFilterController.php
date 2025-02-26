<?php

namespace App\Http\Controllers;


use App\Services\SimpleFilterService;
use Illuminate\Http\Request;

class SimpleFilterController extends Controller
{

    public function __invoke($model, $value){

        $result = SimpleFilterService::filter($model, $value);

        return response()->json($result);
    }
}
