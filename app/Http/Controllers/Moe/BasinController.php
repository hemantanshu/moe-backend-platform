<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\Basin;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class BasinController extends RecordController {
    /**
     * @var string
     */
     protected $model = Basin::class;
}
