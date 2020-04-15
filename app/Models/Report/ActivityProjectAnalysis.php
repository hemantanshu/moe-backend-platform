<?php

namespace App\Models\Report;

use App\Models\Moe\Project;
use App\Models\Moe\WorkActivity;
use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Report\ActivityProjectAnalysisObserver;

/**
 * Class ActivityProjectAnalysis
 * @package App\Models\Report
 */
class ActivityProjectAnalysis extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'rpt_activity_project_analysis';

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
    public function work_activity ()
    {
        return $this->belongsTo(WorkActivity::class);
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ActivityProjectAnalysisObserver());
    }
}
