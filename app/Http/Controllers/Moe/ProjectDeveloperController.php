<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\ProjectDeveloper;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectDeveloperController extends RecordController {
    /**
     * @var string
     */
     protected $model = ProjectDeveloper::class;
}
