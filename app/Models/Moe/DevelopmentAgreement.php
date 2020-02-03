<?php

namespace App\Models\Moe;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\DevelopmentAgreementObserver;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class DevelopmentAgreement
 * @package App\Models\Moe
 */
class DevelopmentAgreement extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_development_agreements';

    /**
     * @return BelongsTo
     */
    public function project ()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new DevelopmentAgreementObserver());
    }
}
