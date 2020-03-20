<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\ProjectLicense;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectLicenseController extends RecordController
{
    /**
     * @var string
     */
    protected $model = ProjectLicense::class;
}
