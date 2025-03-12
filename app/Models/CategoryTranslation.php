<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');

    }
    public function translation(){
        return $this->hasOne(CategoryTranslation::class)->where('lang',app()->getLocale());
    }

}
