<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\CostHead;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class CostHeadController extends RecordController
{
    /**
     * @var string
     */
    protected $model = CostHead::class;
}
