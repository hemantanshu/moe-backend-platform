<?php

namespace App\Models\Moe;

use App\Observers\Moe\ProjectDeveloperObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelUtility\Models\LookupValue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProjectDeveloper
 * @package App\Models\Moe
 */
class ProjectDeveloper extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_project_developers';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ProjectDeveloperObserver());
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
    public function developer ()
    {
        return $this->belongsTo(Developer::class);
    }

    /**
     * @return BelongsTo
     */
    public function developer_type ()
    {
        return $this->belongsTo(LookupValue::class);
    }
}
