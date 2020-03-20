<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\ProjectScheduleDependency;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectScheduleDependencyController extends RecordController
{
    /**
     * @var string
     */
    protected $model = ProjectScheduleDependency::class;
}
