<?php

namespace App\Observers\Moe;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class SubBasinObserver
 * @package App\Observers\Moe
 */
class SubBasinObserver extends BaseObserver
{

    /**
     * @var array
     */
    protected $rules = [
        'basin_id' => 'required',
        'name' => 'required',
    ];
}
