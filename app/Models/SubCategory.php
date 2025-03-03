<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCategory extends Model
{
    protected $guarded = [];
    public function categories(){
        return $this->belongsTo(Category::class,'category_id');

    }

    public function item_translations(): HasMany {
        return $this->hasMany(SubCategoryTranslation::class,'sub_category_id');
    }
    public function translation(){
        return $this->hasOne(SubCategoryTranslation::class)->where('lang',app()->getLocale());
    }

    public function executorInfos(): HasMany
    {
        return $this->hasMany(ExecutorInfo::class);
    }

}
