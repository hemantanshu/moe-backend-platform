<?php

namespace Drivezy\LaravelAdmin\Library;

use Drivezy\LaravelAccessManager\AccessManager;
use Drivezy\LaravelAdmin\Models\UIAction;
use Illuminate\Support\Collection;

/**
 * Class UIActionManager
 * @package Drivezy\LaravelAdmin\Library
 */
class UIActionManager
{
    /**
     * @param $source
     * @param $id
     * @return Collection
     */
    public static function getObjectUIActions ($source, $id)
    {
        $uiActions = [];
        $actions = UIAction::with(['permissions', 'roles'])->where('source_type', $source)->where('source_id', $id)->get();
        foreach ( $actions as $action ) {
            if ( self::isUIActionAllowed($action) )
                array_push($uiActions, UIAction::with(['execution_script', 'filter_condition'])->find($action->id));
        }

        return $uiActions;
    }

    /**
     * validate if ui action is allowed or not
     * @param $uiAction
     * @return bool
     */
    private static function isUIActionAllowed ($uiAction)
    {
        //if no roles or permission assigned then its valid
        if ( sizeof($uiAction->roles) == 0 && sizeof($uiAction->permissions) == 0 ) return true;

        $roles = $permissions = [];

        //check match for role
        foreach ( $uiAction->roles as $role )
            array_push($roles, $role->role_id);
        if ( AccessManager::hasRole($roles) )
            return true;

        //check match for permission
        foreach ( $uiAction->permissions as $permission )
            array_push($permissions, $permission->permission_id);
        if ( AccessManager::hasPermission($permissions) )
            return true;

        return false;
    }
}
