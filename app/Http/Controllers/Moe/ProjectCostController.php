<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\ProjectCost;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectCostController extends RecordController
{
    /**
     * @var string
     */
    protected $model = ProjectCost::class;


}
