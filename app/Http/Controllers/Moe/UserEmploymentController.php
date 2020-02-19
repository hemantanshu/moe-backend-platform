<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\UserEmployment;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class UserEmploymentController extends RecordController {
    /**
     * @var string
     */
     protected $model = UserEmployment::class;
}
