<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\SubBasinObserver;

/**
 * Class SubBasin
 * @package App\Models\Moe
 */
class SubBasin extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_sub_basins';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function basin ()
    {
        return $this->belongsTo(Basin::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rivers ()
    {
        return $this->hasMany(River::class, 'sub_basin_id');
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new SubBasinObserver());
    }
}
