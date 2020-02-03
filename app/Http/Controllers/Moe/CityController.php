<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\City;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class CityController extends RecordController {
    /**
     * @var string
     */
     protected $model = City::class;
}
