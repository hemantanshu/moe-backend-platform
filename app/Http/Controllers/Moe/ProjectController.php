<?php

namespace App\Http\Controllers\Moe;

use App\Libraries\Moe\ActivityTimelineManager;
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculateCriticalPath (Request $request)
    {
        ( new CriticalPathManager($request->project_id) )->process();

        return success_response('generated path properly');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function calculateSuggestedTimeline (Request $request)
    {
        $projectId = $request->project_id;

        ( new CriticalPathManager($projectId) )->fixUpdatedStartTime();
        ( new CriticalPathManager($projectId) )->generateNodes();
        ( new CriticalPathManager($projectId) )->generateLinks();
        ( new ActivityTimelineManager($projectId) )->process();

        return success_response('generated timeline successfully');
    }
}
