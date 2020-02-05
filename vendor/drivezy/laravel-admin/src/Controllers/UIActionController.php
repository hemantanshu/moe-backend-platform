<?php

namespace Drivezy\LaravelAdmin\Controllers;

use Drivezy\LaravelAdmin\Models\UIAction;
use Drivezy\LaravelRecordManager\Controllers\BaseController;

/**
 * Class UIActionController
 * @package Drivezy\LaravelAdmin\Controllers
 */
class UIActionController extends BaseController {
    /**
     * @var string
     */
    protected $model = UIAction::class;
}