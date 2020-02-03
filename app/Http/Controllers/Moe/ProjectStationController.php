<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\ProjectStation;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectStationController extends RecordController {
    /**
     * @var string
     */
     protected $model = ProjectStation::class;
}
