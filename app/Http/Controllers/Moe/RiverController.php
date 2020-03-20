<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\River;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class RiverController extends RecordController
{
    /**
     * @var string
     */
    protected $model = River::class;
}
