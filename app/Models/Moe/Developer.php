<?php

namespace App\Models\Moe;

use App\Observers\Moe\DeveloperObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Developer
 * @package App\Models\Moe
 */
class Developer extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_developer_details';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new DeveloperObserver());
    }

    /**
     * @return BelongsTo
     */
    public function city ()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return HasMany
     */
    public function members ()
    {
        return $this->hasMany(DeveloperMember::class);
    }

    /**
     * @return HasMany
     */
    public function projects ()
    {
        return $this->hasMany(ProjectDeveloper::class);
    }

    /**
     * @return HasMany
     */
    public function purchase_agreements ()
    {
        return $this->hasMany(PurchaseAgreement::class);
    }
}
