<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\BasinObserver;

/**
 * Class Basin
 * @package App\Models\Moe
 */
class Basin extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_basin_details';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sub_basins ()
    {
        return $this->hasMany(SubBasin::class);
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new BasinObserver());
    }
}
