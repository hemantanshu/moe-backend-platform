<?php


namespace Drivezy\LaravelRecordManager\Observers;


use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class ChartPrimaryAxisObserver
 * @package Drivezy\LaravelRecordManager\Observers
 */
class ChartPrimaryAxisObserver extends BaseObserver
{
    /**
     * @var string[]
     */
    protected $rules = [
        'name'     => 'required',
        'chart_id' => 'required',
    ];
}
