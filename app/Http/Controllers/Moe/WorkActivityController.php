<?php

namespace App\Http\Controllers\Moe;

use App\Libraries\Moe\ActivityDelayAnalysisManager;
use App\Models\Moe\WorkActivity;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class WorkActivityController
 * @package @package App\Http\Controllers\Moe
 */
class WorkActivityController extends RecordController
{
    /**
     * @var string
     */
    protected $model = WorkActivity::class;

    public function analyzeSlope ()
    {
        (new ActivityDelayAnalysisManager())->process();
        return success_response('slope analyzed for all activities');
    }
}
