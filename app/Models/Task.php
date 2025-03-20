<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Task extends Model
{
    use FilterTrait;
    protected $guarded = [];
    protected $hidden = ['updated_at'];

    protected $defaultFields = ['sub_category_id', 'location_id', 'status'];
    protected $anyLikeFilterFields = ['title', 'description'];  // or title or description
    protected $boolFilterFields = ['task_type'];


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

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }


    protected function LocationTranslationName(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->location?->translation)->name
        );
    }
}
