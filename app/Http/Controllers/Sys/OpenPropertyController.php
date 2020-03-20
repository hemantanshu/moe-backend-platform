<?php

namespace App\Http\Controllers\Sys;

use App\Models\Sys\OpenProperty;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Sys
 */
class OpenPropertyController extends RecordController
{
    /**
     * @var string
     */
    protected $model = OpenProperty::class;
}
