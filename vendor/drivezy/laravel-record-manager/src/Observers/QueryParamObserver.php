<?php

namespace Drivezy\LaravelRecordManager\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class QueryParamObserver
 * @package Drivezy\LaravelRecordManager\Observers
 */
class QueryParamObserver extends BaseObserver
{
    /**
     * @var string[]
     */
    protected $rules = [
        'query_id' => 'required',
        'param'    => 'required',
    ];
}
