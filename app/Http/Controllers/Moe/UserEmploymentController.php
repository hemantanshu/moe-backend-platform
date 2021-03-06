<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\UserEmployment;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class UserEmploymentController extends RecordController
{
    /**
     * @var string
     */
    protected $model = UserEmployment::class;
}
