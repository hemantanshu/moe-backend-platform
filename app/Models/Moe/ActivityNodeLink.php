<?php

namespace App\Models\Moe;

use App\Observers\Moe\ActivityNodeLinkObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project ()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function head_node ()
    {
        return $this->belongsTo(ProjectActivityNode::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tail_node ()
    {
        return $this->belongsTo(ProjectActivityNode::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function activity ()
    {
        return $this->belongsTo(WorkActivity::class);
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ActivityNodeLinkObserver());
    }
}
