<?php

namespace Drivezy\LaravelRecordManager\Library;

use Drivezy\LaravelRecordManager\Models\DataModel;
use Drivezy\LaravelRecordManager\Models\ModelRelationship;

class RecordBaseManager
{
    public $base = [];
    public $setColumns = false;
    public $parentBase = null;
    public $queryRestrictions = [];

    public function __construct (DataModel $model)
    {
        $base = strtolower($model->name);

        $this->parentBase = $base;
        $this->base[ $base ] = ['model' => $model];

        array_push($this->queryRestrictions, '(`' . $base . '`.deleted_at is null)');
        $this->queryRestrictions = array_merge($this->queryRestrictions, $this->setQueryRestriction($model, $base));

        $this->setModelColumns($base, $model);
    }

    public function setBase ($base)
    {
        $aliases = explode('.', $base);
        $parent = null;

        foreach ( $aliases as $alias ) {
            if ( !$parent ) {
                $parent = $alias;
                continue;
            }

            $base = $parent . '.' . $base;

            if ( isset($this->base[ $base ]) ) continue;

            $relationship = ModelRelationship::with(['reference_model', 'source_column', 'alias_column'])->where('model_id', $this->base[ $parent ]['model']->id)->where('name', $alias)->where('reference_type_id', 41)->first();

            if ( !$relationship ) return;

            if ( !ModelManager::validateModelAccess($relationship->reference_model, 'r') ) return;

            $this->setModelJoins($this->base[ $parent ]['model'], $relationship, $parent);
            $parent = $base;
        }
    }

    private function setModelJoins ($model, $relationship, $base)
    {
        //get the source model definition
        $source = (object) [
            'base'   => $base,
            'table'  => $model->table_name,
            'column' => $relationship->source_column ? $relationship->source_column->name : 'id',
        ];

        //get the related model definition
        $alias = (object) [
            'base'   => $base . '.' . $relationship->name,
            'table'  => $relationship->reference_model->table_name,
            'column' => $relationship->alias_column ? $relationship->alias_column->name : 'id',
        ];

        //get the default join condition
        $joinCondition = '`' . $source->base . '`.' . $source->column . ' = `' . $alias->base . '`.' . $alias->column;
        $joinCondition .= ' and `' . $alias->base . '`.deleted_at is null';

        //check for additional join condition
        if ( $relationship->join_definition ) {
            $join = str_replace('current', '`' . $source->base . '`', $relationship->join_definition);
            $join = str_replace('alias', '`' . $alias->base . '`', $join);

            $joinCondition .= ' AND ' . $join;
        }

        foreach ( $this->setQueryRestriction($relationship->reference_model, $alias->base) as $item )
            $joinCondition .= ' AND ' . $item;

        $this->base[ $alias->base ] = [
            'model' => $relationship->reference_model,
            'join'  => $joinCondition,
        ];
        $this->setModelColumns($alias->base, $relationship->reference_model);
    }

    private function setModelColumns ($base, $model)
    {
        $accepted = $encrypted = $source = [];
        $columns = ModelManager::getModelDictionary($model, 'r');
        foreach ( $columns->allowedIdentifiers as $item ) {
            array_push($accepted, $item);

            //find all encrypted columns and act decrypt them before sending data to the user
            if ( in_array($item, $columns->encryptedColumns) )
                array_push($encrypted, $item);

            //find all the source columns and then change the source
            // values before sending to the end user
            if ( in_array($item, $columns->sourceColumns) )
                array_push($source, $item);
        }

        $this->base[ $base ]['columns'] = [
            'accepted'  => $accepted,
            'encrypted' => $encrypted,
            'source'    => $source,
        ];
    }

    /**
     * @param $model
     * @param $base
     * @return array
     */
    private function setQueryRestriction ($model, $base)
    {
        $joins = [];

        $restrictions = BusinessRuleManager::getQueryStrings($model);
        foreach ( $restrictions as $restriction ) {
            $restriction = str_replace('current', '`' . $base . '`', $restriction);

            //add all current implementation of restrictions
            array_push($joins, '(' . $restriction . ')');
        }

        return $joins;
    }
}
