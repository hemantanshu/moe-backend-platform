<?php

namespace App;

use App\Models\Moe\DeveloperMember;
use App\Models\Moe\UserEducation;
use App\Models\Moe\UserEmployment;
use App\Models\Moe\UserTraining;
use Drivezy\LaravelAccessManager\Models\PermissionAssignment;
use Drivezy\LaravelAccessManager\Models\RoleAssignment;
use Drivezy\LaravelAccessManager\Models\UserGroupMember;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var string
     */
    protected $table = 'sys_users';

    /**
     * @return HasMany
     */
    public function developers ()
    {
        return $this->hasMany(DeveloperMember::class);
    }

    /**
     * @return HasMany
     */
    public function trainings ()
    {
        return $this->hasMany(UserTraining::class);
    }

    /**
     * @return HasMany
     */
    public function roles ()
    {
        return $this->hasMany(RoleAssignment::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * @return HasMany
     */
    public function permissions ()
    {
        return $this->hasMany(PermissionAssignment::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * @return HasMany
     */
    public function user_groups ()
    {
        return $this->hasMany(UserGroupMember::class);
    }

    /**
     * @return HasMany
     */
    public function educations ()
    {
        return $this->hasMany(UserEducation::class);
    }

    /**
     * @return HasMany
     */
    public function employments ()
    {
        return $this->hasMany(UserEmployment::class);
    }
}
