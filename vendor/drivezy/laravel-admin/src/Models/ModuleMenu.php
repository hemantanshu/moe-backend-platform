<?php

namespace Drivezy\LaravelAdmin\Models;

use Drivezy\LaravelAdmin\Observers\ModuleMenuObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

/**
 * Class ModuleMenu
 * @package Drivezy\LaravelAdmin\Models
 */
class ModuleMenu extends BaseModel {
    /**
     * @var string
     */
    protected $table = 'dz_module_menus';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu () {
        return $this->belongsTo(Menu::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module () {
        return $this->belongsTo(Module::class);
    }

    /**
     * Load the observer rule against the model
     */
    public static function boot () {
        parent::boot();
        self::observe(new ModuleMenuObserver());
    }

}