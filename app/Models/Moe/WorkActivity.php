<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\WorkActivityObserver;
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
     * @return HasMany
     */
    public function project_schedules ()
    {
        return $this->hasMany(ProjectSchedule::class, 'work_activity_id');
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new WorkActivityObserver());
    }
}
