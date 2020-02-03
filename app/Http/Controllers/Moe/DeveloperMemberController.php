<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\DeveloperMember;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class DeveloperMemberController extends RecordController {
    /**
     * @var string
     */
     protected $model = DeveloperMember::class;
}
