<?php


namespace Drivezy\LaravelRecordManager\Controllers;


use Drivezy\LaravelRecordManager\Models\Chart;

/**
 * Class ChartController
 * @package Drivezy\LaravelRecordManager\Controllers
 */
class ChartController extends RecordController
{
    /**
     * @var string
     */
    protected $model = Chart::class;
}
