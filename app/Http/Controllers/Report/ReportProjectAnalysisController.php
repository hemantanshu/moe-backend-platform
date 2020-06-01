<?php

namespace App\Http\Controllers\Report;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Report\ReportProjectAnalysis;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Report
 */
class ReportProjectAnalysisController extends RecordController {
    /**
     * @var string
     */
     protected $model = ReportProjectAnalysis::class;
}
