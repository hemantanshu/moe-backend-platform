<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\ProjectDeveloper;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectDeveloperController extends RecordController
{
    /**
     * @var string
     */
    protected $model = ProjectDeveloper::class;
}
