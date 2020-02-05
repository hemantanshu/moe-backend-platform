<?php

namespace Drivezy\LaravelAdmin\Observers;

use Drivezy\LaravelUtility\Observers\BaseObserver;

class ParentMenuObserver extends BaseObserver {

    protected $rules = [
        'menu_id'        => 'required',
        'parent_menu_id' => 'required',
    ];

}