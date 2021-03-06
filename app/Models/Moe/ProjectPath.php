<?php

namespace App\Models\Moe;

use App\Observers\Moe\ProjectPathObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelUtility\Models\LookupValue;

/**
 * Class ProjectPath
 * @package App\Models\Moe
 */
class ProjectPath extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_project_paths';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project ()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function routes ()
    {
        return $this->hasMany(PathRoute::class, 'path_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
//        self::observe(new ProjectPathObserver());
    }
}
