<?php

namespace App\Models\Moe;

use App\Observers\Moe\ZoneObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Zone
 * @package App\Models\Moe
 */
class Zone extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_zone_details';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ZoneObserver());
    }

    /**
     * @return HasMany
     */
    public function districts ()
    {
        return $this->hasMany(District::class);
    }

    /**
     * @return HasMany
     */
    public function projects ()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * @return BelongsTo
     */
    public function country ()
    {
        return $this->belongsTo(Country::class);
    }
}
