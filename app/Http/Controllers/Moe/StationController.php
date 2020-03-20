<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\Station;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class StationController extends RecordController
{
    /**
     * @var string
     */
    protected $model = Station::class;
}
