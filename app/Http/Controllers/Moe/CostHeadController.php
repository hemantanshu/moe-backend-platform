<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\CostHead;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class CostHeadController extends RecordController {
    /**
     * @var string
     */
     protected $model = CostHead::class;
}
