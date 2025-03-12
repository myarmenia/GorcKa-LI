<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategoryTranslation extends Model
{
    protected $guarded = [];
    public function sub_categories(){

        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }

    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
