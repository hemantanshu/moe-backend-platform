<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\ProjectCostObserver;
use Drivezy\LaravelUtility\Models\CommentDetail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ProjectCost
 * @package App\Models\Moe
 */
class ProjectCost extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_project_costs';

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
    public function cost_head ()
    {
        return $this->belongsTo(CostHead::class);
    }

    /**
     * @return HasMany
     */
    public function comments ()
    {
        return $this->hasMany(CommentDetail::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ProjectCostObserver());
    }
}
