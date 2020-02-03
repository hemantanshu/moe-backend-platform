<?php

namespace App\Http\Controllers\Sys;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Sys\OpenProperty;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Sys
 */
class OpenPropertyController extends RecordController {
    /**
     * @var string
     */
     protected $model = OpenProperty::class;
}
