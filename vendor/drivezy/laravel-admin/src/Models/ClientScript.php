<?php

namespace Drivezy\LaravelAdmin\Models;

use Drivezy\LaravelAdmin\Observers\ClientScriptObserver;
use Drivezy\LaravelRecordManager\Models\SystemScript;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelUtility\Models\LookupValue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ClientScript
 * @package Drivezy\LaravelRecordManager\Models
 */
class ClientScript extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'dz_client_scripts';
    /**
     * @var array
     */
    protected $hidden = ['created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ClientScriptObserver());
    }

    /**
     * @return BelongsTo
     */
    public function script ()
    {
        return $this->belongsTo(SystemScript::class);
    }

    /**
     * @return BelongsTo
     */
    public function activity_type ()
    {
        return $this->belongsTo(LookupValue::class);
    }
}
