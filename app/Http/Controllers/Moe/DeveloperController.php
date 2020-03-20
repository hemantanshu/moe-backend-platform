<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\Developer;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class DeveloperController extends RecordController
{
    /**
     * @var string
     */
    protected $model = Developer::class;
}
