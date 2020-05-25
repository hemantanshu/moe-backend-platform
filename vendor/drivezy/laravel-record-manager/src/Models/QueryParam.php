<?php

namespace Drivezy\LaravelRecordManager\Models;

use Drivezy\LaravelRecordManager\Models\ColumnDefinition;
use Drivezy\LaravelRecordManager\Models\DataModel;
use Drivezy\LaravelRecordManager\Observers\QueryParamObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

class QueryParam extends BaseModel {
    protected $table = 'sys_query_params';

    public function reporting_query () {
        return $this->belongsTo(ReportingQuery::class, 'query_id');
    }

    public function param_type () {
        return $this->belongsTo(ColumnDefinition::class, 'param_type_id');
    }

    public function reference_model () {
        return $this->belongsTo(DataModel::class, 'referenced_model_id');
    }

    public static function boot () {
        parent::boot();
        self::observe(new QueryParamObserver());
    }
}
