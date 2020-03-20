<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\UserEducation;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class UserEducationController extends RecordController
{
    /**
     * @var string
     */
    protected $model = UserEducation::class;
}
