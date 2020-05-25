<?php


namespace Drivezy\LaravelRecordManager\Controllers;

use Drivezy\LaravelAccessManager\AccessManager;
use Drivezy\LaravelAccessManager\Models\RoleAssignment;
use Drivezy\LaravelRecordManager\Library\ReportManager;
use Drivezy\LaravelRecordManager\Models\ReportingQuery;
use Illuminate\Http\Request;

/**
 * Class ReportingQueryController
 * @package Drivezy\LaravelRecordManager\Controllers
 */
class ReportingQueryController extends  RecordController
{
    /**
     * @var string
     */
    protected $model = ReportingQuery::class;

    /**
     * @param Request $request
     * @return mixed
     */
    public function index (Request $request)
    {
        if ( AccessManager::hasRole([1, 3]) )
            return parent::index($request);

        $userRoles = AccessManager::getUserObject()->roles;

        $queryId = RoleAssignment::where('source_type', md5(ReportingQuery::class))
            ->whereIn('role_id', $userRoles)
            ->pluck('source_id')->toArray();

        if ( !$queryId )
            $queryId = [0];

        $queryId = implode(',', $queryId);
        $query = ( $request->has('query') && $request->get('query') ) ? $request->get('query') : '1=1';

        $baseQuery = $query . ' AND `reportingquery`.id IN (' . $queryId . ')';

        $request->request->set('query', $baseQuery);

        return parent::index($request);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getReportData (Request $request)
    {
        return fixed_response(ReportManager::getReport($request));
    }
}
