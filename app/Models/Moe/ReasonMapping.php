<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\ReasonMappingObserver;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ReasonMapping
 * @package App\Models\Moe
 */
class ReasonMapping extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'moe_reason_mappings';

    /**
     * @return BelongsTo
     */
    public function reason ()
    {
        return $this->belongsTo(ReasonDefinition::class);
    }

    /**
     * Override the boot functionality to add up the observer
     */
     public static function boot () {
        parent::boot();
        self::observe(new ReasonMappingObserver());
    }
}
