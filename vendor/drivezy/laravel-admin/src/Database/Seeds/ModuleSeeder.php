<?php

namespace Drivezy\LaravelAdmin\Database\Seeds;

use Drivezy\LaravelAdmin\Models\Module;
use Drivezy\LaravelUtility\Database\Seeds\BaseSeeder;

/**
 * Class ModuleSeeder
 * @package Drivezy\LaravelAdmin\Database\Seeds
 */
class ModuleSeeder extends BaseSeeder
{
    /**
     *
     */
    public function run ()
    {
        Module::create([
            'id'            => 1,
            'name'          => 'Developer',
            'description'   => 'Menus related to developer',
            'display_order' => 10,
        ]);
    }
}
