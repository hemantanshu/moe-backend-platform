<?php

namespace Drivezy\LaravelRecordManager\Library;

use Drivezy\LaravelAccessManager\AccessManager;
use Drivezy\LaravelAccessManager\Models\RoleAssignment;
use Drivezy\LaravelRecordManager\Models\QueryColumn;
use Drivezy\LaravelRecordManager\Models\ReportingQuery;
use Drivezy\LaravelRecordManager\Models\SystemScript;
use Drivezy\LaravelUtility\Library\DateUtil;
use Drivezy\LaravelUtility\Library\EventQueueManager;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportManager
{

    public static function getReport ($request)
    {
        if ( !$request->get('query_name') )
            return failure_message('Invalid Request');

        $queryName = explode(',', $request->get('query_name'));

        $queryData = ReportingQuery::whereIn('short_name', $queryName)->get();

        if ( !AccessManager::hasRole([1, 3]) ) {
            foreach ( $queryData as $record ) {
                $queryRoles = RoleAssignment::where('source_type', 'dbcf93ac53125732916013dc60063150')
                    ->where('source_id', $record->id)
                    ->pluck('role_id')->toArray();
                if ( count($queryRoles) ) {
                    if ( !AccessManager::hasRole($queryRoles) )
                        return failure_message('Permission denied for ' . $record->name);
                } else {
                    return failure_message('Permission denied for report ' . $record->name);
                }
            }
        }

        $responseArr['success'] = true;

        if ( $request->get('export') ) {
            if ( sizeof($queryName) == 1 ) {
                $dataArray = self::attachParamsToQuery(self::getScript($queryName[0]), $queryName[0], $request);

                if ( !$dataArray )
                    return failure_message('Parameters missing');

                $responseArr['response'] = $dataArray;

                return $responseArr;
            }

            return failure_message('Feature not supported for multiple query');
        }

        foreach ( $queryName as $item ) {
            $query = self::getScript($item);

            if ( !$query )
                return failure_message('Invalid Request');

            $dataArray = self::attachParamsToQuery($query, $item, $request);

            if ( !$dataArray )
                return failure_message('Parameters missing');

            $responseArr['dictionary'][ $item ] = self::getDictionary($item);

            if ( count($queryName) > 1 ) {
                $responseArr['response'][ $item ] = $dataArray['queryData'];
            } else {
                $responseArr['response'] = $dataArray['queryData'];
                isset($dataArray['stats']) ? $responseArr['stats'] = $dataArray['stats'] : false;
                isset($dataArray['metrics']) ? $responseArr['metrics'] = $dataArray['metrics'] : false;
            }
        }

        return $responseArr;

    }

    /**
     * getting data count and records as per the limit value
     * @param $query
     * @param $queryName
     * @param $request
     * @return mixed
     */
    public static function attachParamsToQuery ($query, $queryName, $request)
    {
        $inputs = $request->except('query_name', 'limit', 'page', 'aggregate_column');

        foreach ( $inputs as $key => $value ) {
            $value = DateUtil::convertLiterals($value);
            $query = str_replace(':' . $key . ':', $value, $query);
        }

        $query = str_replace('#user_id#', Auth::id(), $query);

        preg_match_all("/:[a-z]+/", $query, $params);

        if ( count($params[0]) )
            return false;

        if ( !$request->has('stats') ) {
            $object['queryData'] = self::runDbQuery($query);

            return $object;
        }

        //params for primary data listing
        $limit = $request->has('limit') ? intval($request->get('limit')) : 20;
        $page = $request->has('page') ? intval($request->get('page')) : 1;
        $sorting = $request->has('order') ? $request->get('order') : null;
        $filterQuery = $request->has('query') ? $request->get('query') : '1=1';

        if ( !$sorting ) {
            $getScriptConfig = ReportingQuery::where('short_name', $queryName)->first();
            if ( $getScriptConfig->default_order )
                $sorting = $getScriptConfig->default_order;
            else
                $sorting = '1 DESC';
        }

        //param for grouped data listing
        $groupColumns = ( $request->has('group_column') && $request->get('group_column') ) ? $request->get('group_column') : null;
        $aggregateColumns = ( $request->has('aggregate_column') && $request->get('aggregate_column') ) ? $request->get('aggregate_column') : null;
        $groupFilter = $request->has('group_filter') ? $request->get('group_filter') : null;

        $aggregatedQuery = self::queryGenerator($query, $limit, $page, $sorting, $filterQuery, $groupColumns, $aggregateColumns, $request->get('export'));
        $finalQuery = $groupFilter ? self::generateQueryForGroupFilter($aggregatedQuery, $groupFilter) : $aggregatedQuery;

        if ( $request->get('export') ) {
            return self::exportData($finalQuery, $queryName);
        }

        $object['metrics'] = self::createMetrics($query, $filterQuery, $queryName);

        if ( $request->get('stats') == 'true' ) {
            $object['stats'] = self::getStats($query, $limit, $page, $filterQuery);
            $object['queryData'] = self::runDbQuery($finalQuery);

            return $object;
        }

        $object['queryData'] = self::runDbQuery($finalQuery);

        return $object;
    }

    /**
     * function to return stats
     * @param $query
     * @param $limit
     * @param $filterQuery
     * @return object
     */
    public static function getStats ($query, $limit, $page, $filterQuery)
    {
        $statsObj = (object) [];
        $statsObj->total = self::runDbQuery('SELECT count(*) count FROM(' . $query . ') a WHERE ' . $filterQuery)[0]->count;
        $statsObj->record = $limit;
        $statsObj->page = $page;

        return $statsObj;
    }

    /**
     * generate query as per the parameters
     * @param $query
     * @param $limit
     * @param $page
     * @param $sorting
     * @param $filterQuery
     * @param $group
     * @param $aggregateColumns
     * @param $export
     * @return string
     */
    public static function queryGenerator ($query, $limit, $page, $sorting, $filterQuery, $group, $aggregateColumns, $export)
    {
        if ( $aggregateColumns || $group || $export ) {

            $aggregateColumns = $aggregateColumns ? self::generateAggregateColumns($aggregateColumns) : null;
            $groupColumns = $group ? $group : '*';
            $groupBy = $group ? ' GROUP BY ' . $group : null;

            return 'SELECT ' . $groupColumns . $aggregateColumns . ' FROM(' . $query . ') a WHERE ' . $filterQuery . $groupBy . ' ORDER BY ' . $sorting;
        }

        return 'SELECT * FROM(' . $query . ') a WHERE ' . $filterQuery . ' ORDER BY ' . $sorting . ' LIMIT ' . $limit . ' OFFSET ' . ( $page - 1 ) * $limit;
    }

    /**
     * @param $aggregateColumns
     * @return string
     */
    public static function generateAggregateColumns ($aggregateColumns)
    {
        $string = '';

        foreach ( $aggregateColumns as $value ) {
            $string = $string . ',' . self::getAggregateFunctionValue($value['operator'], $value['column']);
        }

        return $string;
    }

    /**
     * @param $id
     * @param $column
     * @return string
     */
    public static function getAggregateFunctionValue ($id, $column)
    {
        $function = LookupValue::find($id);

        return 'CAST(' . str_replace('columnName', $column, $function->value) . 'AS SIGNED) ' . str_replace(' ', '_', $function->name) . '_of_' . $column;
    }

    /**
     * for filtering the grouped data
     * @param $aggregatedQuery
     * @param $groupFilter
     * @return string
     */
    public static function generateQueryForGroupFilter ($aggregatedQuery, $groupFilter)
    {
        return 'SELECT a.* FROM(' . $aggregatedQuery . ')a WHERE ' . $groupFilter;
    }

    /**
     * function to get the metrics data
     * @param $query
     * @param $filterQuery
     * @param $queryName
     * @return null
     */
    public static function createMetrics ($query, $filterQuery, $queryName)
    {
        $metrics = ReportingQuery::with('user_metrics')->where('short_name', $queryName)->first();

        if ( !count($metrics->user_metrics) ) return null;

        $metricColumns = '';
        foreach ( $metrics->user_metrics as $metric ) {
            $metricColumns = $metricColumns . $metric->query . ' ' . str_replace(' ', '_', $metric->name) . ' ,';
        }

        $metricColumns = rtrim($metricColumns, ' ,');

        try {
            $queryData = self::runDbQuery('SELECT ' . $metricColumns . ' FROM(' . $query . ') a WHERE ' . $filterQuery);
        } catch ( QueryException $e ) {
            return (object) ['Wrong Input' => 'No data to show'];
        }

        return $queryData[0];
    }

    /**
     * @param $query
     * @return mixed
     */
    public static function runDbQuery ($query)
    {
        return DB::connection('read_replica')->select(DB::raw($query));
    }

    /**
     * @param $finalQuery
     * @param $queryName
     * @return bool
     */
    public static function exportData ($finalQuery, $queryName)
    {
        $data['user_id'] = Auth::id();
        $data['query'] = $finalQuery;
        $data['file_name'] = $queryName;

        return EventQueueManager::setEvent('export.query.data', serialize($data));
    }

    /**
     * fetching the script as per shortName
     * @param $shortName
     * @return mixed
     */
    public static function getScript ($shortName)
    {
        $query = ReportingQuery::with('db_query')->where('short_name', $shortName)->first();
        if ( !$query )
            return null;

        return $query->query_id ? $query->db_query->script : null;
    }

    /**
     * get dictionary for query
     * @param $shortName
     * @return mixed
     */
    public static function getDictionary ($shortName)
    {
        $queryDictionary = ReportingQuery::with('dictionary.reference_model')->where('short_name', $shortName)->get();

        return $queryDictionary[0]->dictionary;
    }

    /**
     * refresh the params for query
     * @param $queryId
     * @return \Illuminate\Http\JsonResponse
     */
    public static function refreshQueryParams ($queryId)
    {
        $script = SystemScript::where('source_type', 'dbcf93ac53125732916013dc60063150')
            ->where('source_id', $queryId)->first();

        if ( !$script ) return failed_response('No script found');

        preg_match_all("/:[^:]+:/", $script->script, $params);

        foreach ( $params[0] as $param ) {
            QueryParam::where('query_id', $queryId)
                ->firstOrCreate(['param'    => str_replace(':', '', $param),
                                 'query_id' => $queryId]);
        }

        return true;
    }

    /**
     * refresh the columns for query to create dictionary
     * @param $queryId
     * @return \Illuminate\Http\JsonResponse
     */
    public static function refreshQueryColumns ($queryId)
    {
        $script = SystemScript::where('source_type', 'dbcf93ac53125732916013dc60063150')
            ->where('source_id', $queryId)->first();

        if ( !$script ) return failed_response('No script found!');

        $params = QueryParam::where('query_id', $queryId)->get();

        $query = $script->script;

        if ( count($params) == 0 ) {
            $query = $query;
        } else {
            foreach ( $params as $param ) {
                if ( $param->default_param_value === null ) return failed_response('Default param value missing!');

                $value = DateUtil::convertLiterals($param->default_param_value);
                $query = str_replace(':' . $param->param . ':', $value, $query);
            }
        }

        $query = str_replace('#user_id#', Auth::id(), $query);

        try {
            $data = self::runDbQuery($query . ' LIMIT 1');
        } catch ( QueryException $e ) {
            return failed_response('Script issue!');
        }

        if ( count($data) == 0 ) return failed_response('No records return for params default values!');

        foreach ( $data[0] as $key => $value ) {
            QueryColumn::where('query_id', $queryId)
                ->firstOrCreate(['column_name' => strtolower($key),
                                 'query_id'    => $queryId]);
        }
        self::setDisplayName($queryId);

        return success_response('Columns refreshed');
    }

    /**
     * saving display name for columns
     * @param $query_id
     */
    public static function setDisplayName ($query_id)
    {
        $columnData = QueryColumn::where('query_id', $query_id)->get();

        foreach ( $columnData as $data ) {
            if ( !$data->display_name )
                $data->display_name = ucwords(str_replace('_', ' ', $data->column_name));

            $data->save();
        }

        return;
    }
}
