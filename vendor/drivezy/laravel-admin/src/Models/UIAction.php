<?php

namespace Drivezy\LaravelAdmin\Models;

use Drivezy\LaravelAccessManager\Models\PermissionAssignment;
use Drivezy\LaravelAccessManager\Models\RoleAssignment;
use Drivezy\LaravelAdmin\Observers\UIActionObserver;
use Drivezy\LaravelRecordManager\Models\SystemScript;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class UIAction
 * @package Drivezy\LaravelRecordManager\Models
 */
class UIAction extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'dz_ui_actions';
    /**
     * @var array
     */
    protected $hidden = ['created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at', 'source_type', 'source_id'];

    /**
     * Override the boot functionality to add up the observer
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new UIActionObserver());
    }

    /**
     * @return BelongsTo
     */
    public function filter_condition ()
    {
        return $this->belongsTo(SystemScript::class);
    }

    /**
     * @return BelongsTo
     */
    public function execution_script ()
    {
        return $this->belongsTo(SystemScript::class);
    }

    /**
     * @return BelongsTo
     */
    public function form ()
    {
        return $this->belongsTo(CustomForm::class);
    }

    /**
     * @return HasMany
     */
    public function roles ()
    {
        return $this->hasMany(RoleAssignment::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * @return HasMany
     */
    public function permissions ()
    {
        return $this->hasMany(PermissionAssignment::class, 'source_id')->where('source_type', md5(self::class));
    }
}
