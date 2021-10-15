<?php

namespace AmirVahedix\User\Models;

use AmirVahedix\User\Database\factories\UserFactory;
use AmirVahedix\User\Notifications\ResetPasswordNotification;
use AmirVahedix\User\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, Authorizable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_BAN = 'ban';

    const statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_BAN];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'username',
        'headline',
        'bio',
        'ip',
        'website',
        'linkedin',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'telegram',
        'email_verified_at',
        'password',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function factory()
    {
        return new UserFactory;
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function sendResetPasswordNotification () {
        $this->notify(new ResetPasswordNotification());
    }
}
