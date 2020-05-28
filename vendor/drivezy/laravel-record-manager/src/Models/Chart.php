<?php


namespace Drivezy\LaravelRecordManager\Models;


use Drivezy\LaravelRecordManager\Observers\ChartObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelUtility\Models\LookupValue;

/**
 * Class Chart
 * @package Drivezy\LaravelRecordManager\Models
 */
class Chart extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'dz_chart_details';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function primary_axis ()
    {
        return $this->hasMany(ChartPrimaryAxis::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function secondary_axis ()
    {
        return $this->hasMany(ChartSecondaryAxis::class);
    }

    public function chart_type ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    public function chart_size ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     *
     */
    protected static function boot ()
    {
        parent::boot();
        self::observe(new ChartObserver());
    }
}
