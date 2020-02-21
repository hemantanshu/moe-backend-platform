<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\ProjectCost;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectCostController extends RecordController {
    /**
     * @var string
     */
     protected $model = ProjectCost::class;
}
