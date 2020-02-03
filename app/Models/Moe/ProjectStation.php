<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\ProjectStationObserver;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProjectStation
 * @package App\Models\Moe
 */
class ProjectStation extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_project_stations';

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
    public function station ()
    {
        return $this->belongsTo(Station::class);
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ProjectStationObserver());
    }
}
