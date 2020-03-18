<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\ProjectActivityNode;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectActivityNodeController extends RecordController {
    /**
     * @var string
     */
     protected $model = ProjectActivityNode::class;
}
