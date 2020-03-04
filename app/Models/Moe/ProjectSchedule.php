<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\ProjectScheduleObserver;
use Drivezy\LaravelUtility\Models\CommentDetail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ProjectSchedule
 * @package App\Models\Moe
 */
class ProjectSchedule extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_project_schedules';

    /**
     * @return BelongsTo
     */
    public function project ()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return BelongsTo
     */
    public function work_activity ()
    {
        return $this->belongsTo(WorkActivity::class);
    }

    /**
     * @return HasMany
     */
    public function comments ()
    {
        return $this->hasMany(CommentDetail::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * @return HasMany
     */
    public function reasons ()
    {
        return $this->hasMany(ReasonMapping::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * @return HasMany
     */
    public function dependencies ()
    {
        return $this->hasMany(ProjectScheduleDependency::class);
    }

    /**
     * @return HasMany
     */
    public function dependency_parents ()
    {
        return $this->hasMany(ProjectScheduleDependency::class, 'dependency_id');
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ProjectScheduleObserver());
    }
}
