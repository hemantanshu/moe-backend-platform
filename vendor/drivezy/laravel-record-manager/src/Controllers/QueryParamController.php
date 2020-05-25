<?php


namespace Drivezy\LaravelRecordManager\Controllers;


use Drivezy\LaravelRecordManager\Models\QueryParam;
use Illuminate\Http\Request;

class QueryParamController extends RecordController
{
    protected $model = QueryParam::class;

    /**
     * to refresh the params of query
     * @param Request $request
     * @return mixed
     */
    public static function refreshQueryParams (Request $request) {
        $queryId = $request->get('query_id');

        ReportManager::refreshQueryParams($queryId);

        return success_response('Parameters refreshed');
    }
}
