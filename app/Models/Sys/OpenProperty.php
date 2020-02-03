<?php

namespace App\Models\Sys;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Sys\OpenPropertyObserver;

/**
 * Class OpenProperty
 * @package App\Models\Sys
 */
class OpenProperty extends BaseModel {

    protected $table = 'sys_open_properties';

    /**
     * Override the boot functionality to add up the observer
     */
     public static function boot () {
        parent::boot();
        self::observe(new OpenPropertyObserver());
    }
}