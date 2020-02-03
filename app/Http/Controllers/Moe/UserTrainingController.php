<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\UserTraining;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class UserTrainingController extends RecordController {
    /**
     * @var string
     */
     protected $model = UserTraining::class;
}
