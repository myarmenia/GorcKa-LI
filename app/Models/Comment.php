<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Comment extends Model
{
    protected $guarded = [];

    public function filables(): MorphMany
    {
        return $this->morphMany(Filable::class, 'filable');
    }

}
