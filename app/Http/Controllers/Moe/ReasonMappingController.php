<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\ReasonMapping;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ReasonMappingController extends RecordController
{
    /**
     * @var string
     */
    protected $model = ReasonMapping::class;
}
