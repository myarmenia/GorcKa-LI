<?php
namespace App\Services;

use App\Models\Location;
use App\Models\LocationTranslation;

class LocationFilterService
{

    public static function filter(string $value)
    {

        $query = LocationTranslation::where('name', 'like', "%{$value}%");
        $search_lang = (clone $query)->value('lang');

        $location_ids = $query->pluck('location_id')->toArray();


        $location = Location::whereIn('id', $location_ids)
            ->with([
                'item_translations' => function ($query) use ($search_lang) {
                    $query->where('lang', $search_lang);
                }
            ])
            ->get();

        $result = $location->map(function ($location) {
            // Ищем перевод, в котором поле name удовлетворяет условию
            $matchedTranslation = $location->item_translations->first();
            return [
                'id' => $location->id,
                'name' => $matchedTranslation ? $matchedTranslation->name : null,
            ];
        });


        return $result;

    }


}
