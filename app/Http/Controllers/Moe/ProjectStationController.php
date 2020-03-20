<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\ProjectStation;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectStationController extends RecordController
{
    /**
     * @var string
     */
    protected $model = ProjectStation::class;
}
