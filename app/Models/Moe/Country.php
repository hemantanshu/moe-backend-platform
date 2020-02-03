<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\CountryObserver;

/**
 * Class Country
 * @package App\Models\Moe
 */
class Country extends BaseModel
{

    protected $table = 'moe_country_details';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new CountryObserver());
    }
}
