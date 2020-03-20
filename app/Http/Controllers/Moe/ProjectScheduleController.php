<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\ProjectSchedule;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectScheduleController extends RecordController
{
    /**
     * @var string
     */
    protected $model = ProjectSchedule::class;
}
