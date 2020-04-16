<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\PDATask;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class PDATaskController extends RecordController {
    /**
     * @var string
     */
     protected $model = PDATask::class;
}
