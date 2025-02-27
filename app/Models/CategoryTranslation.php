<?php

namespace App\Models;

use App\Traits\SimpleFilterTrait;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use SimpleFilterTrait;
    public $simpleFilterField = 'name';
    public $relationModel = 'SubCategoryTranslation';

    protected $guarded = [];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');

    }
    public function translation(){
        return $this->hasOne(CategoryTranslation::class)->where('lang',app()->getLocale());
    }

}
