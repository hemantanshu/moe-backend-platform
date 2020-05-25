<?php


namespace Drivezy\LaravelRecordManager\Controllers;


use Drivezy\LaravelRecordManager\Library\ReportManager;
use Drivezy\LaravelRecordManager\Models\QueryColumn;
use Illuminate\Http\Request;

/**
 * Class QueryColumnController
 * @package Drivezy\LaravelRecordManager\Controllers
 */
class QueryColumnController extends RecordController
{
    /**
     * @var string
     */
    protected $model = QueryColumn::class;

    /**
     * to refresh the columns of query
     * @param Request $request
     * @return mixed
     */
    public static function refreshQueryColumns (Request $request) {
        $queryId = $request->get('query_id');

        return ReportManager::refreshQueryColumns($queryId);
    }
}
