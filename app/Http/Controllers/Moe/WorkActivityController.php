<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\WorkActivity;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

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
