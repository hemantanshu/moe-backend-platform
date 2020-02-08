<?php

namespace App\Http\Controllers;

use Drivezy\LaravelRecordManager\Jobs\ObserverEventManagerJob;
use Drivezy\LaravelRecordManager\Library\BusinessRuleManager;
use Drivezy\LaravelRecordManager\Models\Column;
use Drivezy\LaravelRecordManager\Models\ModelRelationship;
use Illuminate\Http\JsonResponse;

/**
 * Class TestController
 * @package App\Http\Controllers
 */
class TestController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function test ()
    {
        //dont let the business rule run when db seeder are executed
        BusinessRuleManager::$enabled = false;

        //dont let the observer event run when db seeder is running
        ObserverEventManagerJob::$enabled = false;

        $relationships = ModelRelationship::where('name', 'created_user')->whereNull('source_column_id')->limit(100)->get();
        foreach ( $relationships as $relationship ) {
            $column = Column::where('source_type', '07b76506c43824b152745fe7df768486')->where('source_id', $relationship->model_id)->where('name', 'created_by')->first();
            if ( !$column ) continue;

            $relationship->source_column_id = $column->id;
            $relationship->save();
        }

        return success_response('seems all good till now!');
    }
}
