<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\ProjectLicenseObserver;
use Drivezy\LaravelUtility\Models\LookupValue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProjectLicense
 * @package App\Models\Moe
 */
class ProjectLicense extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_project_licenses';

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
    public function license_type ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ProjectLicenseObserver());
    }
}
