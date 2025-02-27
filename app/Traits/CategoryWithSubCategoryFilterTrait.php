<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


trait CategoryWithSubCategoryFilterTrait
{


    public function scopeCategoryWithSubCategoryFilter(Builder $query, string $value): Builder
    {

        $query->whereHas('item_translations', function ($subQuery) use ($value) {
            $subQuery->where('name', 'like', "%{$value}%");
        });

        // Фильтрация по субкатегориям и их переводам (SubCategoryTranslation)
        $query->orWhereHas('sub_categories.item_translations', function ($subQuery) use ($value) {
            $subQuery->where('name', 'like', "%{$value}%");
        });

        // dd($query->with('item_translations')->get());

        return $query->with('item_translations');
    }

}
