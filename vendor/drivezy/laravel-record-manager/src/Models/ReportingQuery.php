<?php

namespace Drivezy\LaravelRecordManager\Models;

use Drivezy\LaravelAccessManager\Models\PermissionAssignment;
use Drivezy\LaravelAccessManager\Models\RoleAssignment;
use Drivezy\LaravelAdmin\Models\UIAction;
use Drivezy\LaravelRecordManager\Observers\ReportingQueryObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Support\Facades\Auth;

class ReportingQuery extends BaseModel {
    protected $table = 'sys_reporting_queries';

    public function db_query () {
        return $this->belongsTo(SystemScript::class, 'query_id');
    }

    public function roles () {
        return $this->hasMany(RoleAssignment::class, 'source_id')->where('source_type', md5(self::class));
    }

    public function permissions () {
        return $this->hasMany(PermissionAssignment::class, 'source_id')->where('source_type', md5(self::class));
    }

    public function parameters () {
        return $this->hasMany(QueryParam::class, 'query_id');
    }

    public function dictionary () {
        return $this->hasMany(QueryColumn::class, 'query_id');
    }

    public function preferences () {
        return $this->hasMany(ListPreference::class, 'source_id')
            ->where('source_type', md5(self::class));
    }

    public function list_preferences () {
        return $this->hasMany(ListPreference::class, 'source_id')
            ->where('source_type', md5(self::class))
            ->where(function ($q) {
                $q->whereNull('user_id');
                if ( Auth::check() )
                    $q->orWhere('user_id', Auth::id());
            });
    }

    public function dashboards () {
        return $this->hasMany(ListPreference::class, 'source_id')
            ->where('source_type', 'ReportingDashboard');
    }

    public function user_dashboards () {
        return $this->hasMany(ListPreference::class, 'source_id')
            ->where('source_type', 'ReportingDashboard')
            ->where(function ($q) {
                $q->whereNull('user_id');
                if ( Auth::check() )
                    $q->orWhere('user_id', Auth::id());
            });
    }

    public function metrics () {
        return $this->hasMany(ListPreference::class, 'source_id')
            ->where('source_type', 'ReportingMetric');
    }

    public function user_metrics () {
        return $this->hasMany(ListPreference::class, 'source_id')
            ->where('source_type', 'ReportingMetric')
            ->where(function ($q) {
                $q->whereNull('user_id');
                if ( Auth::check() )
                    $q->orWhere('user_id', Auth::id());
            });
    }

    public function actions () {
        return $this->hasMany(UIAction::class, 'source_id')->where('source_type', md5(self::class));
    }

    public static function boot () {
        parent::boot();
        self::observe(new ReportingQueryObserver());
    }
}
