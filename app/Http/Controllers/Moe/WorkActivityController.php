<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\WorkActivity;

/**
 * Class WorkActivityController
 * @package @package App\Http\Controllers\Moe
 */
class WorkActivityController extends RecordController
{
    /**
     * @var string
     */
    protected $model = WorkActivity::class;
}
