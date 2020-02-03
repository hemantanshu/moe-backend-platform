<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\River;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class RiverController extends RecordController {
    /**
     * @var string
     */
     protected $model = River::class;
}
