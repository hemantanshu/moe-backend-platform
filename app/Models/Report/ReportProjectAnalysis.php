<?php

namespace App\Models\Report;

use Drivezy\LaravelUtility\Models\BaseModel;
use App\Observers\Report\ReportProjectAnalysisObserver;

/**
 * Class ReportProjectAnalysis
 * @package App\Models\Report
 */
class ReportProjectAnalysis extends BaseModel
{

    protected $table = 'rp_project_year_analysis';
}
