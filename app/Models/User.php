<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\FilterTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles, FilterTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];
    protected $defaultFields = ['location_id'];
    protected $likeFilterFields = ['name'];
    protected $boolFilterFields = ['status'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tasks(){
        return $this->hasMany(Task::class);

    }
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);

    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class);

    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);

    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'employer_id');

    }

    public function roomsAll()
    {
        return Room::where(function ($query) {
            $query->where('employer_id', $this->id)
                ->orWhere('executor_id', $this->id);
        });
    }

    public function hasAccessToRoom($roomId)
    {        
        return $this->roomsAll()->where('id', $roomId)->exists();
    }

    public function hasAccessToTask($taskId)
    {        
        return $this->tasks()->where('id', $taskId)->exists();
    }

    
}
