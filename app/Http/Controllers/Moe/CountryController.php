<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\Country;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class CountryController extends RecordController
{
    /**
     * @var string
     */
    protected $model = Country::class;
}
