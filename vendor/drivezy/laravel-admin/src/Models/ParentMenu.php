<?php

namespace Drivezy\LaravelAdmin\Models;

use Drivezy\LaravelAdmin\Observers\ParentMenuObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ParentMenu
 * @package Drivezy\LaravelAdmin\Models
 */
class ParentMenu extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'dz_parent_menus';

    /**
     * Load the observer rule against the model
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ParentMenuObserver());
    }

    /**
     * @return BelongsTo
     */
    public function menu ()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * @return BelongsTo
     */
    public function parent_menu ()
    {
        return $this->belongsTo(Menu::class);
    }
}
