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

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function task()
    {
        return $this->belongsTo(Task::class); // или Order, Project и т.д.
    }

}
