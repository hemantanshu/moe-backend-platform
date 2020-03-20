<?php

namespace App\Models\Moe;

use App\Observers\Moe\PurchageAgreementObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Drivezy\LaravelUtility\Models\LookupValue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class PurchaseAgreement
 * @package App\Models\Moe
 */
class PurchaseAgreement extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_purchase_agreements';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new PurchageAgreementObserver());
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
    public function wet_month ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     * @return BelongsTo
     */
    public function dry_month ()
    {
        return $this->belongsTo(LookupValue::class);
    }
}
