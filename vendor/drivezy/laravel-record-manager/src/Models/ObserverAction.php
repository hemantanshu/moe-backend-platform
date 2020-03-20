<?php

namespace Drivezy\LaravelRecordManager\Models;

use Drivezy\LaravelRecordManager\Observers\ObserverActionObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ObserverAction
 * @package Drivezy\LaravelRecordManager\Models
 */
class ObserverAction extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'dz_observer_actions';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ObserverActionObserver());
    }

    /**
     * @return mixed
     */
    public function observer_rule ()
    {
        return $this->belongsTo(ObserverRule::class);
    }

    /**
     * @return mixed
     */
    public function script ()
    {
        return $this->belongsTo(SystemScript::class);
    }

    /**
     * @return BelongsTo
     */
    public function notification ()
    {
        return $this->belongsTo(Notification::class);
    }
}
