<?php

namespace Drivezy\LaravelRecordManager\Library;

use Drivezy\LaravelRecordManager\Models\Chart;
use Drivezy\LaravelRecordManager\Models\DataModel;
use Drivezy\LaravelRecordManager\Models\ListPreference;
use Drivezy\LaravelUtility\Facade\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class AdminResponseManager
 * @package Drivezy\LaravelRecordManager\Library
 */
class AdminResponseManager
{

    private $request = null;
    private $model = null;

    /**
     * AdminResponseManager constructor.
     * @param Request $request
     * @param DataModel $model
     */
    public function __construct (Request $request, DataModel $model)
    {
        $this->request = $request;
        $this->model = $model;
    }

    /**
     *
     */
    public function index ()
    {
        $request = $this->request;

        $records = ( new ListManager($this->model, [
            'includes'             => $request->has('includes') ? $request->get('includes') : false,
            'layout'               => self::getLayoutDefinition(),
            'stats'                => $request->has('stats') ? $request->get('stats') : false,
            'chart_id'             => $request->has('chart_id') ? $request->get('chart_id') : false,
            'query'                => $request->has('query') ? $request->get('query') : false,
            'sqlCacheIdentifier'   => $request->has('request_identifier') ? $request->get('request_identifier') : false,
            'limit'                => $request->has('limit') ? $request->get('limit') : 20,
            'page'                 => $request->has('page') ? $request->get('page') : 1,
            'aggregation_column'   => $request->has('aggregation_column') ? $request->get('aggregation_column') : null,
            'aggregation_operator' => $request->has('aggregation_operator') ? $request->get('aggregation_operator') : null,
            'order'                => $request->has('order') ? $request->get('order') : null,
            'grouping_column'      => $request->has('group_by') ? $request->get('group_by') : null,
            'trashed'              => ( $request->has('trashed') && ( $request->get('trashed') == 1 ) ) ? true : false,
        ]) )->process();

        $this->exportData($records, $request->has('export') && $request->get('export'), $request->get('layout_id'));

        return success_response($records);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function getLayoutDefinition ()
    {
        $columns = [];
        if ( $this->request->has('chart_id') ) return $this->setChartLayout();

        if ( !$this->request->has('layout_id') ) return $columns;

        $definition = ListPreference::find($this->request->get('layout_id'));
        if ( !$definition ) {
            Message::warn('Layout ' . $this->request->get('layout_id') . ' not found');

            return $columns;
        }

        $definition = json_decode($definition->column_definition, true);
        $keys = ['column', 'object'];

        foreach ( $definition as $item ) {
            if ( !isset($item['object']) ) continue;

            $column = [];
            foreach ( $keys as $key ) {
                if ( isset($item[ $key ]) )
                    $column[ $key ] = $item[ $key ];
            }

            array_push($columns, $column);
        }

        return $columns;
    }

    /**
     * @return array|void
     */
    private function setChartLayout ()
    {
        $chart = Chart::with(['primary_axis', 'secondary_axis'])->find($this->request->get('chart_id'));
        if ( !$chart ) return;

        $columns = [];

        foreach ( $chart->primary_axis as $axis ) {
            $name = explode('.', $axis->name);

            array_push($columns, [
                'column'     => last($name),
                'object'     => implode('.', array_slice($name, 0, sizeof($name) - 1)),
                'group'      => true,
                'identifier' => $name = str_replace(' ', '_', strtolower($axis->display_name)),
            ]);
        }

        foreach ( $chart->secondary_axis as $axis ) {
            $name = explode('.', $axis->name);

            array_push($columns, [
                'column'     => last($name),
                'object'     => implode('.', array_slice($name, 0, sizeof($name) - 1)),
                'operator'   => $axis->operator,
                'identifier' => $name = str_replace(' ', '_', strtolower($axis->display_name)),
            ]);
        }

        return $columns;
    }

    /**
     * Sets job to export data if export is true
     *
     * @see https://justride.atlassian.net/browse/DD-4201
     *
     * @param $records
     * @param $export
     * @param $layoutId
     */
    private function exportData ($records, $export = false, $layoutId)
    {
        if ( !$export ) return;

        $userId = Auth::id();
        $data = [
            'data'     => $records['data'],
            'base'     => strtoupper($records['base']),
            'layoutId' => $layoutId,
            'userId'   => $userId,
        ];
        //@todo give support for event setup in utility class
//        LaravelUtility::setEvent('export.query.data', serialize($data), ['source' => 'USER_REQ_' . $userId]);
    }

    /**
     * @param $id
     */
    public function show ($id)
    {
        $request = $this->request;

        $records = ( new RecordManager($this->model, [
            'includes'           => $request->has('includes') ? $request->get('includes') : false,
            'layout'             => self::getLayoutDefinition(),
            'sqlCacheIdentifier' => $request->has('request_identifier') ? $request->get('request_identifier') : false,
        ]) )->process($id);

        return success_response($records);
    }
}
