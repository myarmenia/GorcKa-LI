<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryTranslation extends Model
{
    protected $guarded = [];
    public function sub_categories(){
        
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
}
