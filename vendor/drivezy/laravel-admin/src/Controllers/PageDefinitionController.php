<?php

namespace Drivezy\LaravelAdmin\Controllers;

use Drivezy\LaravelAdmin\Models\PageDefinition;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PageDefinitionController
 * @package Drivezy\LaravelAdmin\Controllers
 */
class PageDefinitionController extends RecordController {
    /**
     * @var string
     */
    public $model = PageDefinition::class;
}