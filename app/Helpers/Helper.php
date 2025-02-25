<?php

namespace App\Helpers;

use App\Models\Location;
use Illuminate\Support\Collection;
use Request;



class Helper
{

    public static function getLocations(): Collection
    {
        $locations = Location::with([
            'translations' => function ($query) {
                $query->where('lang', app()->getLocale());
            }
        ])->get();

        return $locations;
    }

    public static function filterLocations(Request $request)
    {
        $search = $request->get('search', '');  // Получаем параметр поиска

        // Фильтруем данные по полю 'text', учитывая регистр
        $options = Location::with([
            'translations' => function ($query) use ($search) {
                $query->where('text', 'like', '%' . $search . '%');
            }
        ])->get();

        return response()->json($options);  // Отправляем отфильтрованные данные
    }


}
