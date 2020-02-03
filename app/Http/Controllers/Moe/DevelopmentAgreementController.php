<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\DevelopmentAgreement;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class DevelopmentAgreementController extends RecordController {
    /**
     * @var string
     */
     protected $model = DevelopmentAgreement::class;
}
