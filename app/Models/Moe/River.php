<?php

namespace App\Models\Moe;

use App\Observers\Moe\RiverObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class River
 * @package App\Models\Moe
 */
class River extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_river_details';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new RiverObserver());
    }

    /**
     * @return HasMany
     */
    public function projects ()
    {
        return $this->hasMany(River::class);
    }
}
