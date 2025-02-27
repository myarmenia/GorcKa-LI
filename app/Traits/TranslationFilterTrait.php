<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


trait TranslationFilterTrait
{


    public function scopeTranslationFilter(Builder $query, string $value): Builder
    {

        $result = $query->whereHas('item_translations', function ($q) use ($value) {
            $q->where('name', 'like', "%{$value}%");
        })
            ->with([
                'item_translations' => function ($q) use ($value) {
                    $q->where('name', 'like', "%{$value}%"); // Фильтруем только те переводы, которые содержат нужное имя
                }
            ])
            ->get()
            ->map(function ($location) {
                // Возвращаем только необходимые поля для location с соответствующими переводами
                return [
                    'id' => $location->id,
                    'translations' => $location->translations, // Только те переводы, которые совпали
                ];
            });

        dd($result);

        return $result;
    }

}
