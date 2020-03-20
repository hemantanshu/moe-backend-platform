<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\DevelopmentAgreement;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class DevelopmentAgreementController extends RecordController
{
    /**
     * @var string
     */
    protected $model = DevelopmentAgreement::class;
}
