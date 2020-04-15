<?php

namespace App\Http\Controllers\Report;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Report\ActivityProjectAnalysis;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Report
 */
class ActivityProjectAnalysisController extends RecordController {
    /**
     * @var string
     */
     protected $model = ActivityProjectAnalysis::class;
}
