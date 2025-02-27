<?php
namespace App\Services;


class FilterService
{

    public static function filter(string $model, string $value, string $filterMethod)
    {
        $modelClass = 'App\\Models\\' . $model;

        if (!class_exists($modelClass)) {
            abort(404, 'Model not found');
        }

        $instance = new $modelClass();

        if (!method_exists($instance, $filterMethod)) {
            abort(400, 'Model does not support the specified filter method');
        }

        $method = substr($filterMethod, 5);  // Убираем 'scope' из начала имени метода

        // Динамически вызываем метод
        return call_user_func([$modelClass, $method], $value)->get();  // == $modelClass::simpleFilter($value)->get();
    }


}
