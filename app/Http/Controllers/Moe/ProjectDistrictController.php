<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\ProjectDistrict;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectDistrictController extends RecordController
{
    /**
     * @var string
     */
    protected $model = ProjectDistrict::class;
}
