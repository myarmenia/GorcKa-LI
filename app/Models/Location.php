<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = [];
    public function item_translations(){

        return $this->hasMany(LocationTranslation::class);
    }
    public function translation(){
        
        return $this->hasOne(LocationTranslation::class )->where('lang',app()->getLocale());
    }


}
