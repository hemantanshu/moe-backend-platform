<?php

namespace Drivezy\LaravelRecordManager\Models;

use Drivezy\LaravelRecordManager\Observers\QueryColumnObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

class QueryColumn extends BaseModel {
    protected $table = 'sys_query_columns';

    public function reporting_query () {
        return $this->belongsTo(ReportingQuery::class, 'query_id');
    }

    public function reference_model () {
        return $this->belongsTo(DataModel::class, 'referenced_model_id');
    }

    public function column_type () {
        return $this->belongsTo(ColumnDefinition::class, 'column_type_id');
    }

    public static function boot () {
        parent::boot();
        self::observe(new QueryColumnObserver());
    }
}
