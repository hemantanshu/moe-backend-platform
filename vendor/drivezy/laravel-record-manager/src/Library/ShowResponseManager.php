<?php

namespace Drivezy\LaravelRecordManager\Library;

use Drivezy\LaravelRecordManager\Models\DataModel;
use Drivezy\LaravelRecordManager\Models\ListPreference;
use Drivezy\LaravelUtility\Facade\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class NewResponseManager
 * @package Drivezy\LaravelRecordManager\Library
 */
class ShowResponseManager
{
    private $request, $model, $baseManager;
    private $layouts = [];
    private $options = [];

    private $columns = [
        'accepted'  => [],
        'encrypted' => [],
        'source'    => [],
    ];

    private $sql = [];

    /**
     * NewResponseManager constructor.
     * @param Request $request
     * @param DataModel $model
     */
    public function __construct (Request $request, DataModel $model, $options = [])
    {
        $this->request = $request;
        $this->model = $model;

        $this->parentBase = strtolower($model->name);

        foreach ( $options as $key => $value )
            $this->options[ $key ] = $value;

        $this->baseManager = new RecordBaseManager($model);
    }

    public function process ()
    {
        $this->flattenLayouts();
        $this->processLayouts();

        $this->generateSelects();
        $this->generateTableJoins();
        $this->getQuery();
    }

    private function getQuery ()
    {
        $sql = "SELECT " . $this->sql['select'] . " FROM " . $this->sql['table'] . " WHERE " . implode('AND ', $this->baseManager->queryRestrictions);

        return DB::select(DB::raw($sql));
    }

    private function generateTableJoins ()
    {
        $tableJoins = null;
        foreach ( $this->baseManager->base as $key => $value ) {
            $table = $value['model']->table_name . ' `' . $key . '`';
            $join = isset($value['join']) ? 'ON ' . $value['join'] . '' : '';

            if ( $tableJoins ) {
                $tableJoins = $tableJoins . ' LEFT JOIN ' . $table . ' ' . $join;
            } else {
                $tableJoins = $table;
            }
        }

        $this->sql['table'] = $tableJoins;
    }

    private function generateSelects ()
    {
        foreach ( $this->layouts as $key => $columns ) {
            $allowedColumns = $this->baseManager->base[ $key ]['columns'];

            foreach ( $columns as $item ) {
                if ( !in_array($item, $allowedColumns['accepted']) ) continue;

                $name = "`{$key}`.{$item} as '{$key}.{$item}'";
                $alias = $key . '.' . $item;
                
                array_push($this->columns['accepted'], $name);

                if ( in_array($item, $allowedColumns['encrypted']) )
                    array_push($this->columns['encrypted'], $alias);

                if ( in_array($item, $allowedColumns['source']) )
                    array_push($this->columns['source'], $alias);
            }
        }
        $this->sql['select'] = implode(',', $this->columns['accepted']);
    }

    private function processLayouts ()
    {
        $this->baseManager = new RecordBaseManager($this->model);
        foreach ( $this->layouts as $key => $value )
            $this->baseManager->setBase($key);

        return success_response($this->baseManager->base);
    }

    private function flattenLayouts ()
    {
        if ( !$this->request->has('layout_id') ) return false;

        $layoutId = $this->request->get('layout_id');

        $definition = ListPreference::find($layoutId);
        if ( !$definition ) {
            Message::warn('Layout ' . $layoutId . ' not found');

            return $columns;
        }

        $definition = json_decode($definition->column_definition, true);

        foreach ( $definition as $item ) {
            if ( !isset($item['object']) ) continue;

            $object = $item['object'];
            $column = $item['column'];

            if ( !isset($this->layouts[ $object ]) ) $this->layouts[ $object ] = [];

            array_push($this->layouts[ $object ], $column);
        }
    }
}
