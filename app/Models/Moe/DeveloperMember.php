<?php

namespace App\Models\Moe;

use App\Observers\Moe\DeveloperMemberObserver;
use App\User;
use Drivezy\LaravelUtility\Models\BaseModel;
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
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new DeveloperMemberObserver());
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
    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
