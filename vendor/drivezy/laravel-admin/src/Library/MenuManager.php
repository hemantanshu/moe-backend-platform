<?php

namespace Drivezy\LaravelAdmin\Library;

use Drivezy\LaravelAccessManager\AccessManager;
use Drivezy\LaravelAdmin\Models\Menu;
use Drivezy\LaravelAdmin\Models\Module;
use Drivezy\LaravelAdmin\Models\ModuleMenu;
use Drivezy\LaravelAdmin\Models\PageDefinition;
use Drivezy\LaravelRecordManager\Library\PreferenceManager;
use Illuminate\Support\Facades\Response;

/**
 * Class MenuManager
 * @package Drivezy\LaravelAdmin\Library
 */
class MenuManager {
    private static $unwanted_columns = ['created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public static function getMenuDetails ($id) {
        $menu = Menu::find($id);
        $menu->list_layouts = PreferenceManager::getListPreference(md5(Menu::class), $id);
        $menu->ui_actions = UIActionManager::getObjectUIActions(md5(Menu::class), $id);

        return Response::json(['success' => true, 'response' => $menu]);
    }

    /**
     * Get all the menus that the user is authorized against.
     * Child menu validation is not required. If parent is authorized
     * then child would automatically be added without any validation
     */
    public static function getMenus () {
        Menu::$hidden_columns = self::$unwanted_columns;
        Module::$hidden_columns = self::$unwanted_columns;

        $modules = $ids = [];
        $records = Module::get();

        $modules['paths'] = PageDefinition::get();
        $modules['modules'] = [];

        foreach ( $records as $record ) {
            $associations = ModuleMenu::with(['menu.roles', 'menu.permissions', 'menu.child_menus'])
                ->where('module_id', $record->id)->get();

            $menus = [];
            foreach ( $associations as $menu ) {
                $menu = $menu->menu;

                //validate the access against the menu
                if ( !self::validateMenuAccess($menu) ) continue;

                //clean up the menu and its relationships
                $childs = $menu->child_menus;
                unset($menu->child_menus);
                unset($menu->roles);
                unset($menu->permissions);

                array_push($menus, $menu);

                //get the dependent menus also loaded up
                foreach ( $childs as $child ) {
                    //check if the child menus is already incorporated
                    if ( in_array($child->menu_id, $ids) ) continue;

                    array_push($ids, $child->menu_id);
                    array_push($menus, $child->menu);
                }
            }

            //set up the module only when the menu is set
            if ( sizeof($menus) ) {
                $record->menus = $menus;
                array_push($modules['modules'], $record);
            }
        }

        return $modules;
    }

    /**
     * check if user has access to the menu object
     * @param $menu
     */
    private static function validateMenuAccess ($menu) {
        $roles = $permissions = [];

        //super admin should have complete access
        if ( AccessManager::hasRole(1) ) return true;

        //get the roles to check & validate
        foreach ( $menu->roles as $assignment )
            array_push($roles, $assignment->role_id);

        if ( AccessManager::hasRole($roles) ) return true;


        //check for the permissions to check & validate
        foreach ( $menu->permissions as $assignment )
            array_push($permissions, $assignment->permission_id);

        if ( AccessManager::hasPermission($permissions) ) return true;

        //if there are no roles or permissions in the array return true
        if ( empty($roles) && empty($permissions) ) return true;

        //user doesnt have access to the object
        return false;
    }
}