<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Helpers\DateHelper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([UserObserver::class])]

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public static function booted()
    {
        static::creating(function (self $user) {
            $user->start_at = Carbon::createFromFormat('m/d/Y', $user->start_at)->format('Y-m-d');
            $user->password = bcrypt($user->password);
        });
        static::creating(function (self $user) {
            $user->username = Str::slug($user->name);
            $user->notification_settings = [
                'receive_mention_notifications',
                'receive_comment_reply_notifications',
            ];
            $user->per_page_setting = ['5','15','25'];
        });

        static::updating(function (self $user) {
            $user->username = Str::lower($user->username);
        });
    }
    protected function startAt(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => DateHelper::convertToDB($value)
    );
    }

}
