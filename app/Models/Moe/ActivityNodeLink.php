<?php

namespace App\Models\Moe;

use App\Observers\Moe\ActivityNodeLinkObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelUtility\Models\LookupValue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ActivityNodeLink
 * @package App\Models\Moe
 */
class ActivityNodeLink extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_activity_node_links';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ActivityNodeLinkObserver());
    }

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
    public function head_node ()
    {
        return $this->belongsTo(ProjectActivityNode::class);
    }

    /**
     * @return BelongsTo
     */
    public function tail_node ()
    {
        return $this->belongsTo(ProjectActivityNode::class);
    }

    /**
     * @return BelongsTo
     */
    public function activity ()
    {
        return $this->belongsTo(WorkActivity::class);
    }

    /**
     * @return BelongsTo
     */
    public function type ()
    {
        return $this->belongsTo(LookupValue::class);
    }
}
