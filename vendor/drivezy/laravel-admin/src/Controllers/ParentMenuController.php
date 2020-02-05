<?php

namespace Drivezy\LaravelAdmin\Controllers;

use Drivezy\LaravelAdmin\Models\ParentMenu;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class ParentMenuController
 * @package Drivezy\LaravelAdmin\Controllers
 */
class ParentMenuController extends RecordController {
    /**
     * @var string
     */
    public $model = ParentMenu::class;
}