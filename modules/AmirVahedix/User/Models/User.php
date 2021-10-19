<?php

namespace AmirVahedix\User\Models;

use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Course\Models\Course;
use AmirVahedix\Course\Models\Season;
use AmirVahedix\Media\Models\Media;
use AmirVahedix\User\Database\factories\UserFactory;
use AmirVahedix\User\Notifications\ResetPasswordNotification;
use AmirVahedix\User\Notifications\VerifyEmailNotification;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail, Authorizable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    // region constants
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_BAN = 'ban';

    const statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_BAN];
    // endregion constants

    // region model config
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'username',
        'avatar_id',
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function factory()
    {
        return new UserFactory;
    }
    // endregion model config

    // region notifications
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    public function sendResetPasswordNotification () {
        $this->notify(new ResetPasswordNotification());
    }
    // endregion notifications

    // region relations
    public function avatar()
    {
        return $this->belongsTo(Media::class, 'avatar_id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function seasons()
    {
        return $this->hasMany(Season::class);
    }

    public function purchases()
    {
        return $this->belongsToMany(
            Course::class,
            'course_students',
            'user_id',
            'course_id'
        );
    }
    // endregion relations

    // region custom attributes
    public function getUserAvatarAttribute()
    {
        if (!$this->avatar) return null;

        $avatars = (array) json_decode($this->avatar->files);
        return "/storage/$avatars[600]";
    }
    // endregion custom attributes

    // region custom methods
    public function hasAccessToCourse(Course $course)
    {
        if ($this->hasPermissionTo(Permission::PERMISSION_SUPER_ADMIN)) return true;
        if ($this->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) return true;
        if ($this->id == $course->teacher_id) return true;
        if ($course->students->contains($this->id)) return true;
        return false;
    }
    // endregion custom methods
}
