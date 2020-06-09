<?php

namespace Drivezy\LaravelRecordManager\Controllers;

use Drivezy\LaravelRecordManager\Library\ColumnManager;
use Drivezy\LaravelRecordManager\Library\ModelManager;
use Drivezy\LaravelRecordManager\Models\DataModel;
use Drivezy\LaravelRecordManager\Models\ModelRelationship;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class DataModelController
 * @package Drivezy\LaravelRecordManager\Controller
 */
class DataModelController extends RecordController
{
    /**
     * @var string
     */
    public $model = DataModel::class;

    /**
     * get data related to the source polymorphic table
     * @param Request $request
     * @return JsonResponse
     */
    public function getSourceColumnDetails (Request $request)
    {
        return success_response(ColumnManager::getSourceColumnDetails($request->source_type, $request->source_id));
    }

    /**
     * @param Request $request
     * @param $hash
     * @return JsonResponse
     */
    public function getModelDictionary (Request $request, $hash)
    {
        $model = DataModel::where('model_hash', $hash)->first();
        if ( !ModelManager::validateModelAccess($model, 'r') ) return invalid_operation();

        $columns = ModelManager::getModelDictionary($model, 'r');
        $aliases = [];

        $relationships = ModelRelationship::with('reference_model')->where('model_id', $model->id)->get();
        foreach ( $relationships as $relationship ) {
            if ( ModelManager::validateModelAccess($relationship->reference_model, 'r') )
                array_push($aliases, $relationship);
        }

        $model->dictionary = $columns->allowed;
        $model->relationships = $aliases;

        return success_response($model);
    }
}
