<?php

namespace Drivezy\LaravelRecordManager\Library;

/**
 * Class NewDataManager
 * @package Drivezy\LaravelRecordManager\Library
 */
class NewDataManager
{
    /**
     * @var array
     */
    protected $columns = [
        'accepted'  => [],
        'encrypted' => [],
        'source'    => [],
    ];

    /**
     * @param $base
     * @param $model
     */
    protected function setColumns ($base, $model)
    {
        $columns = ModelManager::getModelDictionary($model, 'r');
        foreach ( $columns->allowedIdentifiers as $item ) {
            array_push($this->columns['accepted'], $base . '.' . $item);

            //find all encrypted columns and act decrypt them before sending data to the user
            if ( in_array($item, $columns->encryptedColumns) )
                array_push($this->columns['encrypted'], $base . '.' . $item);

            //find all the source columns and then change the source
            // values before sending to the end user
            if ( in_array($item, $columns->sourceColumns) )
                array_push($this->columns['source'], $base . '.' . $item);
        }
    }

    protected function getModelDetails ($model)
    {
        if ( !ModelManager::validateModelAccess($model, 'r') ) return false;

        $columns = ModelManager::getModelDictionary($model, 'r');
    }
}
