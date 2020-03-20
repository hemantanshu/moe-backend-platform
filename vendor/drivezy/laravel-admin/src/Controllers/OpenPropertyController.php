<?php

namespace Drivezy\LaravelAdmin\Controllers;

use Drivezy\LaravelAdmin\Models\OpenProperty;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class OpenPropertyController
 * @package Drivezy\LaravelAdmin\Controllers
 */
class OpenPropertyController extends RecordController
{
    /**
     * @var string
     */
    protected $model = OpenProperty::class;
}
