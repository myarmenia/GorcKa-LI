<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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
    public const REQUIRED_POINTS_FOR_CLICK = 19;
    protected $appends = ['avatar_url','location_translation'];
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

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);

    }
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);

    }

    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class);

    }

    public function files(): MorphMany
    {
        return $this->morphMany(Filable::class, 'filable');
    }

    public function social_medias(): HasMany
    {
        return $this->hasMany(SocialMedia::class);

    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);

    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);

    }

    public function rooms(): HasMany
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


    public function executor_sub_categories(): BelongsToMany
    {
        return $this->belongsToMany(
            SubCategory::class,
            'executor_sl_sub_categories', // имя pivot-таблицы
            // 'user_id',                    // внешний ключ пользователя
            // 'sub_category_id'            // внешний ключ подкатегории
        );
    }

    public function receivedComments(): HasMany
    {
        return $this->hasMany(Comment::class, 'recipient_id');
    }

    public function writtenComments(): HasMany
    {
        return $this->hasMany(Comment::class, 'author_id');
    }


    public function hasAccessToRoom($roomId): bool
    {        
        return $this->roomsAll()->where('id', $roomId)->exists();
    }

    public function hasAccessToTask($taskId): bool
    {        
        return $this->tasks()->where('id', $taskId)->exists();
    }

      
    public function hasAccessToJobApplicant($taskId): bool
    {        
        
        $has = $this->applicants()->where('task_id', $taskId)->exists();
        return !$has ? $this->hasAccessToTask($taskId) : $has;
    }

    protected function avatarUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->avatar ? asset('storage/' . $this->avatar) : asset('assets/user/images/user.svg'),
        );
    }
    protected function locationTranslation(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->location?->translation)->name
        );
    }

    public function hasEnoughPointsForClick(): bool
    {
        return $this->point >= self::REQUIRED_POINTS_FOR_CLICK;
    }


    public function referral_code(): HasOne
    {
        return $this->hasOne(ReferralCode::class, 'user_id');
    }

    public function referrer(){
        $this->referral_code->user;
    }
    
}
