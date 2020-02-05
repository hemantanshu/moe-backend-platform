<?php

namespace Drivezy\LaravelAdmin\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

class ModuleMenuObserver extends BaseObserver {
    protected $rules = [
        'menu_id'   => 'required',
        'module_id' => 'required',
    ];
}