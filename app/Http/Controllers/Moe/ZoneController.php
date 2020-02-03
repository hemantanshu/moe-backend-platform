<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\Zone;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ZoneController extends RecordController {
    /**
     * @var string
     */
     protected $model = Zone::class;
}
