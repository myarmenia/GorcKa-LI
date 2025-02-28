<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;


trait SimpleFilterTrait
{


    public function scopeSimpleFilter(Builder $query, string $value): Builder
    {

        if (property_exists($this, 'simpleFilterField') && $this->simpleFilterField) {
            return $query->where($this->simpleFilterField, 'like', "%{$value}%");
        }

        return $query->with('item_translations');
    }

}
