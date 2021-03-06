<?php

namespace App\Models\Moe;

use App\Observers\Moe\ProjectObserver;
use Drivezy\LaravelRecordManager\Models\DocumentManager;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelUtility\Models\CommentDetail;
use Drivezy\LaravelUtility\Models\LookupValue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Project
 * @package App\Models\Moe
 */
class Project extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_project_details';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ProjectObserver());
    }

    /**
     * @return HasMany
     */
    public function development_agreements ()
    {
        return $this->hasMany(DevelopmentAgreement::class);
    }

    /**
     * @return BelongsTo
     */
    public function river ()
    {
        return $this->belongsTo(River::class);
    }

    /**
     * @return BelongsTo
     */
    public function zone ()
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * @return BelongsTo
     */
    public function category ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     * @return BelongsTo
     */
    public function project_type ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     * @return BelongsTo
     */
    public function project_stage ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     * @return BelongsTo
     */
    public function project_scheme ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     * @return HasMany
     */
    public function developers ()
    {
        return $this->hasMany(ProjectDeveloper::class);
    }

    /**
     * @return HasMany
     */
    public function districts ()
    {
        return $this->hasMany(ProjectDistrict::class);
    }

    /**
     * @return HasMany
     */
    public function licenses ()
    {
        return $this->hasMany(ProjectLicense::class);
    }

    /**
     * @return HasMany
     */
    public function stations ()
    {
        return $this->hasMany(ProjectStation::class);
    }

    /**
     * @return HasMany
     */
    public function purchase_agreements ()
    {
        return $this->hasMany(PurchaseAgreement::class);
    }

    /**
     * @return HasMany
     */
    public function documents ()
    {
        return $this->hasMany(DocumentManager::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * @return HasMany
     */
    public function project_schedules ()
    {
        return $this->hasMany(ProjectSchedule::class);
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
    public function project_costs ()
    {
        return $this->hasMany(ProjectCost::class);
    }

    /**
     * @return HasMany
     */
    public function activity_nodes ()
    {
        return $this->hasMany(ProjectActivityNode::class);
    }

    /**
     * @return HasMany
     */
    public function node_links ()
    {
        return $this->hasMany(ActivityNodeLink::class);
    }

    /**
     * @return HasMany
     */
    public function paths ()
    {
        return $this->hasMany(ProjectPath::class);
    }

    /**
     * @return HasMany
     */
    public function path_routes ()
    {
        return $this->hasMany(PathRoute::class);
    }
}
