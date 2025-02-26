<?php

namespace App\Models;

use App\Traits\SimpleFilterTrait;
use Illuminate\Database\Eloquent\Model;

class LocationTranslation extends Model
{
    use SimpleFilterTrait;

    public $simpleFilterField = 'name';
    protected $guarded = [];

    public function location(){

        return $this->belongsTo(Location::class,'location_id');
    }

}
