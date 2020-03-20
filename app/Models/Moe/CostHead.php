<?php

namespace App\Models\Moe;

use App\Observers\Moe\CostHeadObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelUtility\Models\LookupValue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CostHead
 * @package App\Models\Moe
 */
class CostHead extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_cost_details';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new CostHeadObserver());
    }

    /**
     * @return HasMany
     */
    public function projects ()
    {
        return $this->hasMany(ProjectCost::class);
    }

    /**
     * @return BelongsTo
     */
    public function category ()
    {
        return $this->belongsTo(LookupValue::class);
    }
}
