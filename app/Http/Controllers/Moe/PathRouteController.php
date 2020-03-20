<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\PathRoute;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class PathRouteController extends RecordController {
    /**
     * @var string
     */
     protected $model = PathRoute::class;
}
