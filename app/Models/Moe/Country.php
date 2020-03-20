<?php

namespace App\Models\Moe;

use App\Observers\Moe\CountryObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
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
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new CountryObserver());
    }

    /**
     * @return HasMany
     */
    public function zones ()
    {
        return $this->hasMany(Zone::class);
    }
}
