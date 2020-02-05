<?php

namespace Drivezy\LaravelAdmin\Database\Seeds;

use Drivezy\LaravelAdmin\Models\ModuleMenu;
use Drivezy\LaravelUtility\Database\Seeds\BaseSeeder;

/**
 * Class ModuleMenuSeeder
 * @package Drivezy\LaravelAdmin\Database\Seeds
 */
class ModuleMenuSeeder extends BaseSeeder {

    /**
     *
     */
    public function run () {
        $records = [
            [
                'module_id'     => 1,
                'menu_id'       => 1,
                'display_order' => 1,
            ],
            [
                'module_id'     => 1,
                'menu_id'       => 2,
                'display_order' => 1,
            ],
            [
                'module_id'     => 1,
                'menu_id'       => 3,
                'display_order' => 1,
            ],
        ];

        foreach ( $records as $record )
            ModuleMenu::create($record);
    }
}
