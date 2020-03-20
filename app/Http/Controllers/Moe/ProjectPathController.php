<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\ProjectPath;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectPathController extends RecordController {
    /**
     * @var string
     */
     protected $model = ProjectPath::class;
}
