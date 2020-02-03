<?php

namespace App\Models\Moe;

use App\User;
use Drivezy\LaravelUtility\LaravelUtility;
use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Moe\DeveloperMemberObserver;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class DeveloperMember
 * @package App\Models\Moe
 */
class DeveloperMember extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'moe_developer_members';

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
        self::observe(new DeveloperMemberObserver());
    }
}
