<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\ProjectSchedule;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectScheduleController extends RecordController {
    /**
     * @var string
     */
     protected $model = ProjectSchedule::class;
}
