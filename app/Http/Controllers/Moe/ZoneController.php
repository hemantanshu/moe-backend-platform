<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\Zone;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ZoneController extends RecordController
{
    /**
     * @var string
     */
    protected $model = Zone::class;
}
