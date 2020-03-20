<?php

namespace App\Models\Moe;

use App\Observers\Moe\UserTrainingObserver;
use App\User;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserTraining
 * @package App\Models\Moe
 */
class UserTraining extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_user_trainings';

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new UserTrainingObserver());
    }

    /**
     * @return BelongsTo
     */
    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
