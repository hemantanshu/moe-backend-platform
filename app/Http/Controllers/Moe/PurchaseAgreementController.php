<?php

namespace App\Http\Controllers\Moe;

use App\Models\Moe\PurchaseAgreement;
use Drivezy\LaravelRecordManager\Controllers\RecordController;

/**
 * Class PropertyController
 * @package @package App\Http\Controllers\Moe
 */
class PurchaseAgreementController extends RecordController
{
    /**
     * @var string
     */
    protected $model = PurchaseAgreement::class;
}
