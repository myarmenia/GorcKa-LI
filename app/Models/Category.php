<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function category_translations(){
        return $this->hasMany(CategoryTranslation::class);
    }
    public function sub_categories(){
        return $this->hasMany(SubCategory::class);
    }
}
