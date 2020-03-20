<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\City;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class CityController extends RecordController
{
    /**
     * @var string
     */
    protected $model = City::class;
}
