<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\SubBasin;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class SubBasinController extends RecordController {
    /**
     * @var string
     */
     protected $model = SubBasin::class;
}
