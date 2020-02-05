<?php

namespace Drivezy\LaravelAdmin\Models;

use Drivezy\LaravelAdmin\Observers\ParentMenuObserver;
use Drivezy\LaravelUtility\Models\BaseModel;

/**
 * Class ParentMenu
 * @package Drivezy\LaravelAdmin\Models
 */
class ParentMenu extends BaseModel {
    /**
     * @var string
     */
    protected $table = 'dz_parent_menus';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu () {
        return $this->belongsTo(Menu::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent_menu () {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Load the observer rule against the model
     */
    public static function boot () {
        parent::boot();
        self::observe(new ParentMenuObserver());
    }
}