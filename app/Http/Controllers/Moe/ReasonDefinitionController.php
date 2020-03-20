<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\ReasonDefinition;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ReasonDefinitionController extends RecordController
{
    /**
     * @var string
     */
    protected $model = ReasonDefinition::class;
}
