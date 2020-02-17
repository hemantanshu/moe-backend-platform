<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\CountryObserver;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Country
 * @package App\Models\Moe
 */
class Country extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_country_details';

    /**
     * @return HasMany
     */
    public function zones ()
    {
        return $this->hasMany(Zone::class);
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new CountryObserver());
    }
}
