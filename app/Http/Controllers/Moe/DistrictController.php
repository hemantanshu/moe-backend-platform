<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\District;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class DistrictController extends RecordController
{
    /**
     * @var string
     */
    protected $model = District::class;
}
