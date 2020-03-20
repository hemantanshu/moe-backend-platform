<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\ProjectActivityNode;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class ProjectActivityNodeController extends RecordController
{
    /**
     * @var string
     */
    protected $model = ProjectActivityNode::class;
}
