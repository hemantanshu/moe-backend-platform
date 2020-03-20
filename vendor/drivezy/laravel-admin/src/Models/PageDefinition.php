<?php

namespace Drivezy\LaravelAdmin\Models;

use Drivezy\LaravelAdmin\Observers\PageDefinitionObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

/**
 * Class PageDefinition
 * @package Drivezy\LaravelAdmin\Models
 */
class PageDefinition extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'dz_page_definitions';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new PageDefinitionObserver());
    }
}
