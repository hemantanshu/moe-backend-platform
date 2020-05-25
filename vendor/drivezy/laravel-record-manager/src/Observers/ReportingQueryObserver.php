<?php

namespace Drivezy\LaravelRecordManager\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class ReportingQueryObserver
 * @package Drivezy\LaravelRecordManager\Observers
 */
class ReportingQueryObserver extends BaseObserver
{
    /**
     * @var string[]
     */
    protected $rules = [
        'name'       => 'required',
        'short_name' => 'required',
    ];
}
