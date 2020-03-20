<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\UserTraining;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class UserTrainingController extends RecordController
{
    /**
     * @var string
     */
    protected $model = UserTraining::class;
}
