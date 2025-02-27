<?php
namespace App\Services;


class CategoryWithSubCategoryFilterService
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
