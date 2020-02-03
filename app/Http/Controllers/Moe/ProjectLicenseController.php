<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\ProjectLicense;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectLicenseController extends RecordController {
    /**
     * @var string
     */
     protected $model = ProjectLicense::class;
}
