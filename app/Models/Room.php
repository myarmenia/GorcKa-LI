<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use SoftDeletes;
    protected $guarded = [];
    // protected $appends = ['executo'];
    public function employer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'employer_id');

    }

    public function executor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'executor_id');
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id');

    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($room) {
            $room->messages()->delete();
        });
    }


    // protected function executo(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn() => $this->executor ? [
    //             'name' => $this->executor->name,
    //             'avatar' => $this->executor->avatar
    //         ] : null
    //     );
    // }

}
