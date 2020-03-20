<?php

namespace Drivezy\LaravelAdmin\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

class ModuleObserver extends BaseObserver
{
    protected $rules = [
        'name' => 'required',
    ];
}
