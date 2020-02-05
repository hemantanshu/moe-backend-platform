<?php

namespace Drivezy\LaravelAdmin\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class PageDefinitionObserver
 * @package Drivezy\LaravelAdmin\Observers
 */
class PageDefinitionObserver extends BaseObserver {
    /**
     * @var array
     */
    protected $rules = [
        'name' => 'required',
        'path' => 'required',
    ];
}