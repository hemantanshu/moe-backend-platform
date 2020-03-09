<?php

namespace Drivezy\LaravelRecordManager\Models;

use Drivezy\LaravelRecordManager\Observers\DocumentManagerObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelUtility\Models\LookupValue;

/**
 * Class DocumentManager
 * @package Drivezy\LaravelRecordManager\Models
 */
class DocumentManager extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'dz_document_details';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type ()
    {
        return $this->belongsTo(LookupValue::class, 'document_type_id');
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new DocumentManagerObserver());
    }
}
