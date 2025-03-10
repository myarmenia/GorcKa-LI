<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ExecutorInfo extends Model
{
    use FilterTrait;
    protected $guarded = [];

    protected $defaultFields = ['sub_category_id'];

    protected $relationFilter = [
        'user' => ['location_id', 'name', 'status']
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function activeUser()
    {
        return $this->belongsTo(User::class, 'user_id')->where('status', 1);
    }

    public function sub_category(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }



    public function filables(): MorphMany
    {
        return $this->morphMany(Filable::class, 'filable');
    }

}
