<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\Developer;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class DeveloperController extends RecordController {
    /**
     * @var string
     */
     protected $model = Developer::class;
}
