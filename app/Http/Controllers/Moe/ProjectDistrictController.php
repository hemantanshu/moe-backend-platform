<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\ProjectDistrict;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectDistrictController extends RecordController {
    /**
     * @var string
     */
     protected $model = ProjectDistrict::class;
}
