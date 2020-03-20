<?php

namespace Drivezy\LaravelAdmin\Database\Seeds;

use Drivezy\LaravelAdmin\Models\ParentMenu;
use Drivezy\LaravelUtility\Database\Seeds\BaseSeeder;

/**
 * Class ParentMenuSeeder
 * @package Drivezy\LaravelAdmin\Database\Seeds
 */
class ParentMenuSeeder extends BaseSeeder
{

    /**
     *
     */
    public function run ()
    {
        $records = [
            [
                'menu_id'        => 4,
                'parent_menu_id' => 1,
            ],
            [
                'menu_id'        => 5,
                'parent_menu_id' => 2,
            ],
            [
                'menu_id'        => 6,
                'parent_menu_id' => 3,
            ],
        ];

        foreach ( $records as $record )
            ParentMenu::create($record);
    }
}
