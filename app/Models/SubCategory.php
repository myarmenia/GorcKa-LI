<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $guarded = [];

    public function sub_category_translations(){
        return $this->hasMany(SubCategoryTranslation::class,'sub_category_id');
    }
}
