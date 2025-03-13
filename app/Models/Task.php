<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Task extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];



    public function files(): MorphMany
    {
        return $this->morphMany(Filable::class, 'filable');
    }

    public function user(): BelongsTo{

        return $this->belongsTo(User::class,'user_id');
    }

    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');

    }


}
