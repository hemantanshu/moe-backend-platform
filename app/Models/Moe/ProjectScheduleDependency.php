<?php

namespace App\Models\Moe;

use App\Observers\Moe\ProjectScheduleDependencyObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProjectScheduleDependency
 * @package App\Models\Moe
 */
class ProjectScheduleDependency extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_project_schedule_dependencies';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ProjectScheduleDependencyObserver());
    }

    /**
     * @return BelongsTo
     */
    public function project_schedule ()
    {
        return $this->belongsTo(ProjectSchedule::class);
    }

    /**
     * @return BelongsTo
     */
    public function dependency ()
    {
        return $this->belongsTo(ProjectSchedule::class);
    }
}
