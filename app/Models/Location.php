<?php

namespace App\Models;

use App\Traits\TranslationFilterTrait;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use TranslationFilterTrait;

    protected $guarded = [];


    public function translations()
    {
        return $this->hasMany(LocationTranslation::class);
    }

    public function item_translations(){

        return $this->hasMany(LocationTranslation::class);
    }
    public function translation(){

        return $this->hasOne(LocationTranslation::class )->where('lang',app()->getLocale());
    }



}
