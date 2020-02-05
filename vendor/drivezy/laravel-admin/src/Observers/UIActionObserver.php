<?php

namespace Drivezy\LaravelAdmin\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class UIActionObserver
 * @package Drivezy\LaravelAdmin\Observers
 */
class UIActionObserver extends BaseObserver {
    /**
     * @var array
     */
    protected $rules = [
        'source_type' => 'required',
        'source_id'   => 'required',
    ];
}