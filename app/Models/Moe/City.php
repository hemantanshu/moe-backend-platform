<?php

namespace App\Models\Moe;

use App\Observers\Moe\CityObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class City
 * @package App\Models\Moe
 */
class City extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_city_details';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new CityObserver());
    }

    /**
     * @return BelongsTo
     */
    public function district ()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * @return HasMany
     */
    public function developers ()
    {
        return $this->hasMany(Developer::class);
    }
}
