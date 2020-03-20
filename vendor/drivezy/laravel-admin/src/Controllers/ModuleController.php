<?php

namespace Drivezy\LaravelAdmin\Controllers;

use Drivezy\LaravelAdmin\Models\Module;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class ModuleController
 * @package Drivezy\LaravelAdmin\Controllers
 */
class ModuleController extends RecordController
{
    /**
     * @var string
     */
    public $model = Module::class;
}
