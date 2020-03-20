<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\DeveloperMember;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class DeveloperMemberController extends RecordController
{
    /**
     * @var string
     */
    protected $model = DeveloperMember::class;
}
