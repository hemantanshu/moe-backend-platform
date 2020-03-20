<?php

namespace App\Models\Moe;

use App\Observers\Moe\WorkActivityObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelUtility\Models\LookupValue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class WorkSchedule
 * @package App\Models\Moe
 */
class WorkActivity extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_work_activities';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new WorkActivityObserver());
    }

    /**
     * @return HasMany
     */
    public function project_schedules ()
    {
        return $this->hasMany(ProjectSchedule::class, 'work_activity_id');
    }

    /**
     * @return BelongsTo
     */
    public function category ()
    {
        return $this->belongsTo(LookupValue::class);
    }
}
