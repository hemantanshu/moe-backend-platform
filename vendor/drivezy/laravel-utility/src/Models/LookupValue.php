<?php

namespace Drivezy\LaravelUtility\Models;


use Drivezy\LaravelUtility\Observers\LookupValueObserver;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class LookupValue
 * @package Drivezy\LaravelUtility\Models
 */
class LookupValue extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'dz_lookup_values';

    /**
     * Load the observer rule against the model
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new LookupValueObserver());
    }

    /**
     * @return BelongsTo
     */
    public function lookup_type ()
    {
        return $this->belongsTo(LookupType::class);
    }

}
