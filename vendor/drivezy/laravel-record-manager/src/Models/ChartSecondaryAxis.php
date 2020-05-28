<?php


namespace Drivezy\LaravelRecordManager\Models;


use Drivezy\LaravelRecordManager\Observers\ChartSecondaryAxisObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

class ChartSecondaryAxis extends BaseModel
{
    protected $table = 'dz_chart_secondary_axis';

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
        self::observe(new ChartSecondaryAxisObserver());
    }
}
