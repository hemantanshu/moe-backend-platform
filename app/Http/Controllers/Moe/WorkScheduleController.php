<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\WorkSchedule;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class WorkScheduleController extends RecordController {
    /**
     * @var string
     */
     protected $model = WorkSchedule::class;
}
