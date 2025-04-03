<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Storage;

class Filable extends Model
{
    protected $fillable = ['name', 'path',];
    public function filable(): MorphTo
    {
        return $this->morphTo();

    }

    public function getFilePathAttribute($value)
    {
        return asset('storage/'. $value);
    }
}
