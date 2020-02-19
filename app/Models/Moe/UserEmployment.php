<?php

namespace App\Models\Moe;

use App\User;
use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\UserEmploymentObserver;
use Drivezy\LaravelUtility\Models\LookupValue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserEmployment
 * @package App\Models\Moe
 */
class UserEmployment extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_user_employments';

    /**
     * @return BelongsTo
     */
    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function organization ()
    {
        return $this->belongsTo(Developer::class);
    }

    /**
     * @return BelongsTo
     */
    public function designation ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new UserEmploymentObserver());
    }
}
