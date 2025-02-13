<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Filable extends Model
{
    protected $fillable = ['file_name', 'file_path'];
    public function filable(): MorphTo
    {
        return $this->morphTo();
    }
}
