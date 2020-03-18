<?php

namespace App\Models\Moe;

use App\Observers\Moe\ProjectActivityNodeObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

/**
 * Class ProjectActivityNode
 * @package App\Models\Moe
 */
class ProjectActivityNode extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_project_activity_nodes';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project ()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project_schedule ()
    {
        return $this->belongsTo(ProjectSchedule::class);
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ProjectActivityNodeObserver());
    }
}
