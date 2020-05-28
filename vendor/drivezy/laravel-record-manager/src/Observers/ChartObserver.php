<?php

namespace Drivezy\LaravelRecordManager\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class ChartObserver
 * @package Drivezy\LaravelRecordManager\Observers
 */
class ChartObserver extends BaseObserver
{
    /**
     * @var string[]
     */
    protected $rules = [
        'source_type' => 'required',
    ];
}
