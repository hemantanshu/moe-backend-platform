<?php

namespace App\Models\Moe;

use App\Observers\Moe\ReasonDefinitionObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelUtility\Models\LookupValue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ReasonDefinition
 * @package App\Models\Moe
 */
class ReasonDefinition extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_reason_definitions';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ReasonDefinitionObserver());
    }

    /**
     * @return BelongsTo
     */
    public function type ()
    {
        return $this->belongsTo(LookupValue::class);
    }
}
