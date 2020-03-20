<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\ActivityNodeLink;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ActivityNodeLinkController extends RecordController
{
    /**
     * @var string
     */
    protected $model = ActivityNodeLink::class;
}
