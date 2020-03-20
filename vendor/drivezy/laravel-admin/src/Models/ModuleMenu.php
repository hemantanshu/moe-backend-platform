<?php

namespace Drivezy\LaravelAdmin\Models;

use Drivezy\LaravelAdmin\Observers\ModuleMenuObserver;
use Drivezy\LaravelUtility\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ModuleMenu
 * @package Drivezy\LaravelAdmin\Models
 */
class ModuleMenu extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'dz_module_menus';

    /**
     * Load the observer rule against the model
     */
    public static function boot ()
    {
        parent::boot();
        self::observe(new ModuleMenuObserver());
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
    public function module ()
    {
        return $this->belongsTo(Module::class);
    }

}
