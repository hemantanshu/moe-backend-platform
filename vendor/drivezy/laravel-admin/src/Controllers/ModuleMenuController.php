<?php

namespace Drivezy\LaravelAdmin\Controllers;

use Drivezy\LaravelAdmin\Models\ModuleMenu;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class ModuleMenuController
 * @package Drivezy\LaravelAdmin\Controllers
 */
class ModuleMenuController extends RecordController {
    /**
     * @var string
     */
    public $model = ModuleMenu::class;
}