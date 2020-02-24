<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\ReasonDefinitionObserver;

/**
 * Class ReasonDefinition
 * @package App\Models\Moe
 */
class ReasonDefinition extends BaseModel {

    protected $table = 'moe_reason_definitions';

    /**
     * Override the boot functionality to add up the observer
     */
     public static function boot () {
        parent::boot();
        self::observe(new ReasonDefinitionObserver());
    }
}