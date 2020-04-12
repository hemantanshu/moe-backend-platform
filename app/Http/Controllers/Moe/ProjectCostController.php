<?php

namespace App\Http\Controllers\Moe;

use App\Libraries\Moe\CostAnalysisManager;
use App\Models\Moe\ProjectCost;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectCostController extends RecordController
{
    /**
     * @var string
     */
    protected $model = ProjectCost::class;

    public function analyzeSlope ()
    {
        ( new CostAnalysisManager() )->process();

        return success_response('slope analyzed for all costs');
    }
}
