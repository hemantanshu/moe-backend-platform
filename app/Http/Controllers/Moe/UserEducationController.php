<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\UserEducation;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class UserEducationController extends RecordController {
    /**
     * @var string
     */
     protected $model = UserEducation::class;
}
