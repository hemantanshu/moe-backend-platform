<?php

namespace App\Models\Moe;

use App\Observers\Moe\ProjectDistrictObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProjectDistrict
 * @package App\Models\Moe
 */
class ProjectDistrict extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_project_districts';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ProjectDistrictObserver());
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
    public function district ()
    {
        return $this->belongsTo(District::class);
    }
}
