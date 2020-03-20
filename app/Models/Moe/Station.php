<?php

namespace App\Models\Moe;

use App\Observers\Moe\StationObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Station
 * @package App\Models\Moe
 */
class Station extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_station_details';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new StationObserver());
    }

    /**
     * @return HasMany
     */
    public function projects ()
    {
        return $this->hasMany(ProjectStation::class);
    }

    /**
     * @return BelongsTo
     */
    public function district ()
    {
        return $this->belongsTo(District::class);
    }
}
