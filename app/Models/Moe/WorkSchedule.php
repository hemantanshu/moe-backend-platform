<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\WorkScheduleObserver;

/**
 * Class WorkSchedule
 * @package App\Models\Moe
 */
class WorkSchedule extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_work_schedules';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function project_schedules ()
    {
        return $this->hasMany(ProjectSchedule::class, 'work_schedule_id');
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new WorkScheduleObserver());
    }
}
