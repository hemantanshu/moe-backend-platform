<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\District;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class DistrictController extends RecordController {
    /**
     * @var string
     */
     protected $model = District::class;
}
