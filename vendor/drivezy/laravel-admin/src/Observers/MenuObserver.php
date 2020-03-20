<?php

namespace Drivezy\LaravelAdmin\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

class MenuObserver extends BaseObserver
{
    protected $rules = [
        'name' => 'required',
        'url'  => 'required',
    ];
}
