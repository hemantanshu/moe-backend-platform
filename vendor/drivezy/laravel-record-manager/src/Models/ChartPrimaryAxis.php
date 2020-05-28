<?php


namespace Drivezy\LaravelRecordManager\Models;


use Drivezy\LaravelRecordManager\Observers\ChartPrimaryAxisObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

/**
 * Class ChartPrimaryAxis
 * @package Drivezy\LaravelRecordManager\Models
 */
class ChartPrimaryAxis extends BaseModel
{
    protected $table = 'dz_chart_primary_axis';

    public function chart ()
    {
        return $this->belongsTo(Chart::class);
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ChartPrimaryAxisObserver());
    }
}
