<?php

namespace App\Models\Moe;

use App\Observers\Moe\PathRouteObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

/**
 * Class PathRoute
 * @package App\Models\Moe
 */
class PathRoute extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_path_routes';

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
    public function path ()
    {
        return $this->belongsTo(ProjectPath::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function node ()
    {
        return $this->belongsTo(ProjectActivityNode::class);
    }


    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new PathRouteObserver());
    }
}
