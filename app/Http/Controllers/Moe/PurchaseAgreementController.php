<?php

namespace App\Http\Controllers\Moe;

use Drivezy\LaravelRecordManager\Controllers\RecordController;
use App\Models\Moe\PurchaseAgreement;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class PurchaseAgreementController extends RecordController {
    /**
     * @var string
     */
     protected $model = PurchaseAgreement::class;
}
