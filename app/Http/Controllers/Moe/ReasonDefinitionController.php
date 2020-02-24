<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\ReasonDefinition;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ReasonDefinitionController extends RecordController {
    /**
     * @var string
     */
     protected $model = ReasonDefinition::class;
}
