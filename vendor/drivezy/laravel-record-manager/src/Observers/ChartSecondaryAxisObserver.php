<?php


namespace Drivezy\LaravelRecordManager\Observers;


use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class ChartSecondaryAxisObserver
 * @package Drivezy\LaravelRecordManager\Observers
 */
class ChartSecondaryAxisObserver extends BaseObserver
{
    /**
     * @var string[]
     */
    protected $rules = [
        'chart_id' => 'required',
    ];
}
