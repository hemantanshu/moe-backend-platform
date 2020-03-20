<?php

namespace App\Models\Moe;

use App\Observers\Moe\DistrictObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class District
 * @package App\Models\Moe
 */
class District extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_district_details';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new DistrictObserver());
    }

    /**
     * @return HasMany
     */
    public function cities ()
    {
        return $this->hasMany(City::class);
    }

    /**
     * @return BelongsTo
     */
    public function zone ()
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * @return HasMany
     */
    public function projects ()
    {
        return $this->hasMany(Project::class);
    }
}
