<?php

namespace Drivezy\LaravelRecordManager\Models;

use Drivezy\LaravelAccessManager\Models\PermissionAssignment;
use Drivezy\LaravelAccessManager\Models\RoleAssignment;
use Drivezy\LaravelAdmin\Models\UIAction;
use Drivezy\LaravelRecordManager\Observers\ReportingQueryObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Support\Facades\Auth;

/**
 * Class ReportingQuery
 * @package Drivezy\LaravelRecordManager\Models
 */
class ReportingQuery extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'sys_reporting_queries';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function db_query ()
    {
        return $this->belongsTo(SystemScript::class, 'query_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles ()
    {
        return $this->hasMany(RoleAssignment::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions ()
    {
        return $this->hasMany(PermissionAssignment::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parameters ()
    {
        return $this->hasMany(QueryParam::class, 'query_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dictionary ()
    {
        return $this->hasMany(QueryColumn::class, 'query_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function preferences ()
    {
        return $this->hasMany(ListPreference::class, 'source_id')
            ->where('source_type', md5(self::class));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function list_preferences ()
    {
        return $this->hasMany(ListPreference::class, 'source_id')
            ->where('source_type', md5(self::class))
            ->where(function ($q) {
                $q->whereNull('user_id');
                if ( Auth::check() )
                    $q->orWhere('user_id', Auth::id());
            });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dashboards ()
    {
        return $this->hasMany(ListPreference::class, 'source_id')
            ->where('source_type', 'ReportingDashboard');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_dashboards ()
    {
        return $this->hasMany(ListPreference::class, 'source_id')
            ->where('source_type', 'ReportingDashboard')
            ->where(function ($q) {
                $q->whereNull('user_id');
                if ( Auth::check() )
                    $q->orWhere('user_id', Auth::id());
            });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function metrics ()
    {
        return $this->hasMany(ListPreference::class, 'source_id')
            ->where('source_type', 'ReportingMetric');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_metrics ()
    {
        return $this->hasMany(ListPreference::class, 'source_id')
            ->where('source_type', 'ReportingMetric')
            ->where(function ($q) {
                $q->whereNull('user_id');
                if ( Auth::check() )
                    $q->orWhere('user_id', Auth::id());
            });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function actions ()
    {
        return $this->hasMany(UIAction::class, 'source_id')->where('source_type', md5(self::class));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function charts ()
    {
        return $this->hasMany(Chart::class, 'source_id')->where('source_type', md5(self::class))->where('active', true);
    }

    /**
     *
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ReportingQueryObserver());
    }
}
