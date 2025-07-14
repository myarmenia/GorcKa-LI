<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{

    protected $guarded = [];


    public function item_translations(){

        return $this->hasMany(LocationTranslation::class);
    }
    public function translation($lang=null){
        $lang=$lang ?? app()->getLocale() ;
     
        return $this->hasOne(LocationTranslation::class )->where('lang',$lang );
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }



}
