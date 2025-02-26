<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class SimpleFilterService
{

    public static function filter(string $model, string $value)
    {
        // $modelClass = 'App\\Models\\' . ucfirst($model);
        $modelClass = 'App\\Models\\' . $model;


        if (!class_exists($modelClass)) {
            abort(404, 'Model not found');
        }


        $instance = new $modelClass();

        if (!method_exists($instance, 'scopeSimpleFilter')) {
            abort(400, 'Model does not support SimpleFilterTrait');
        }

        return $modelClass::simpleFilter($value)->get();
    }
}
