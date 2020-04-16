<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\ProjectPDATask;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectPDATaskController extends RecordController {
    /**
     * @var string
     */
     protected $model = ProjectPDATask::class;
}
