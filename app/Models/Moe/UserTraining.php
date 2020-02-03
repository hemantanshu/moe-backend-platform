<?php

namespace App\Models\Moe;

use App\User;
use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\UserTrainingObserver;
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
        self::observe(new UserTrainingObserver());
    }
}
