<?php

namespace App\Models\Moe;

use App\User;
use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\UserEducationObserver;
use Drivezy\LaravelUtility\Models\LookupValue;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserEducation
 * @package App\Models\Moe
 */
class UserEducation extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_user_educations';

    /**
     * @return BelongsTo
     */
    public function degree_type ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     * @return BelongsTo
     */
    public function college ()
    {
        return $this->belongsTo(LookupValue::class);
    }

    /**
     * @return BelongsTo
     */
    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new UserEducationObserver());
    }
}
