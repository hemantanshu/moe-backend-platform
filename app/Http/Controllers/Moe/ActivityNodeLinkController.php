<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\ActivityNodeLink;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ActivityNodeLinkController extends RecordController {
    /**
     * @var string
     */
     protected $model = ActivityNodeLink::class;
}
