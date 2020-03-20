<?php

namespace Drivezy\LaravelAdmin\Models;

use Drivezy\LaravelAdmin\Observers\OpenPropertyObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

/**
 * Class OpenProperty
 * @package Drivezy\LaravelAdmin\Models
 */
class OpenProperty extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'dz_open_properties';

    /**
     *
     */
    protected static function boot ()
    {
        parent::boot();
        self::observe(new OpenPropertyObserver());
    }

}
