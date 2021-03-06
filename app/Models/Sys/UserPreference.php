<?php

namespace App\Models\Sys;

use App\Observers\Sys\UserPreferenceObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

/**
 * Class UserPreference
 * @package App\Models\Sys
 */
class UserPreference extends BaseModel
{

    protected $table = 'sys_user_preferences';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new UserPreferenceObserver());
    }
}
