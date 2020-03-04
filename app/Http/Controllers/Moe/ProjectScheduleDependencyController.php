<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\ProjectScheduleDependency;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectScheduleDependencyController extends RecordController {
    /**
     * @var string
     */
     protected $model = ProjectScheduleDependency::class;
}
