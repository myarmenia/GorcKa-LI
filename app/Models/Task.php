<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Storage;

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

    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);
    }


    protected function authApplicant(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->applicants)->where('user_id', Auth::id())->isNotEmpty()
        );
    }

    protected function LocationTranslationName(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->location?->translation)->name
        );
    }

    public function applicantUsers(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Applicant::class, 'task_id', 'id', 'id', 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeActiveByTable($query)
    {
        return $query->where('tasks.status', 'active');
    }

    // public function hasAccessToJobApplicant($userId)
    // {        
    //     dd(22);
    //     return $this->applicantUsers()->where('id', $userId)->exists();
    // }


}
