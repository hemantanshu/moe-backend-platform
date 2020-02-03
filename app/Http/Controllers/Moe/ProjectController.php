<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\Project;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectController extends RecordController {
    /**
     * @var string
     */
     protected $model = Project::class;
}
