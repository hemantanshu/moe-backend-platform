<?php

namespace Drivezy\LaravelAdmin\Controllers;

use Drivezy\LaravelAdmin\Library\MenuManager;
use Drivezy\LaravelAdmin\Models\Menu;
use Drivezy\LaravelRecordManager\Controllers\RecordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

/**
 * Class MenuController
 * @package Drivezy\LaravelAdmin\Controllers
 */
class MenuController extends RecordController {
    /**
     * @var string
     */
    public $model = Menu::class;

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function getMenuDetails (Request $request, $id) {
        return MenuManager::getMenuDetails($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getMenus (Request $request) {
        return success_response(MenuManager::getMenus());
    }
}