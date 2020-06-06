<?php

namespace App\Observers\Moe;

use Drivezy\LaravelUtility\Observers\BaseObserver;

/**
 * Class BasinObserver
 * @package App\Observers\Moe
 */
class BasinObserver extends BaseObserver
{

    /**
     * @var array
     */
    protected $rules = [
        'name' => 'required',
    ];
}
