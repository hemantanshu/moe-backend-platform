<?php

namespace App\Models\Sys;

use App\Observers\Sys\OpenPropertyObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

/**
 * Class OpenProperty
 * @package App\Models\Sys
 */
class OpenProperty extends BaseModel
{

    protected $table = 'sys_open_properties';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new OpenPropertyObserver());
    }
}
