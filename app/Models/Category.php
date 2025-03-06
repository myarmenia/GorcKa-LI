<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function item_translations(){
        return $this->hasMany(CategoryTranslation::class);
    }
    public function translation(){
        return $this->hasOne(CategoryTranslation::class)->where('lang',app()->getLocale());
    }

    public function sub_categories(){
        return $this->hasMany(SubCategory::class);
    }
}
