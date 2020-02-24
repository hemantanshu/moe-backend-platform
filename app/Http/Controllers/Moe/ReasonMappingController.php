<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\ReasonMapping;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ReasonMappingController extends RecordController {
    /**
     * @var string
     */
     protected $model = ReasonMapping::class;
}
