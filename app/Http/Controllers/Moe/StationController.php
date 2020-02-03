<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\Station;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class StationController extends RecordController {
    /**
     * @var string
     */
     protected $model = Station::class;
}
