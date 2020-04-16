<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\PDATaskObserver;

/**
 * Class PDATask
 * @package App\Models\Moe
 */
class PDATask extends BaseModel {

    protected $table = 'moe_pda_tasks';

    /**
     * Override the boot functionality to add up the observer
     */
     public static function boot () {
        parent::boot();
        self::observe(new PDATaskObserver());
    }
}