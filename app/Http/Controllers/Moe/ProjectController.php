<?php

namespace App\Http\Controllers\Moe;

use App\Libraries\Moe\CriticalPathManager;
use App\Models\Moe\Project;
use Drivezy\LaravelRecordManager\Controllers\RecordController;
use Illuminate\Http\Request;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectController extends RecordController
{
    /**
     * @var string
     */
    protected $model = Project::class;

    public function calculateCriticalPath (Request $request)
    {
        ( new CriticalPathManager($request->project_id) )->process();

        return success_response('generated path properly');
    }
}
