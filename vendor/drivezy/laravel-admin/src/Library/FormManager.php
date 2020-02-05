<?php

namespace Drivezy\LaravelAdmin\Library;

use Drivezy\LaravelAccessManager\AccessManager;
use Drivezy\LaravelAccessManager\Models\PermissionAssignment;
use Drivezy\LaravelAccessManager\Models\RoleAssignment;
use Drivezy\LaravelAdmin\Models\CustomForm;
use Drivezy\LaravelRecordManager\Library\ColumnManager;
use Drivezy\LaravelRecordManager\Library\SecurityRuleManager;

class FormManager {
    /**
     * @param $formId
     * @return bool
     */
    public static function validateFormAccess ($formId) {
        //get all the roles attached to the form
        $roles = RoleAssignment::where('source_type', md5(CustomForm::class))->where('source_id', $formId)->pluck('role_id')->toArray();
        if ( AccessManager::hasRole($roles) ) return true;

        //get all the permissions attached to the form
        $permissions = PermissionAssignment::where('source_type', md5(CustomForm::class))->where('source_id', $formId)->pluck('permission_id')->toArray();
        if ( AccessManager::hasPermission($permissions) ) return true;

        //if either of the entity is true then it violated security policy
        if ( sizeof($roles) || sizeof($permissions) ) return false;

        return true;
    }

    /**
     * @param CustomForm $form
     * @return bool|ColumnManager
     */
    public static function getFormDictionary (CustomForm $form) {
        //get all security rules attached to this model
        $securityRules = SecurityRuleManager::getFormSecurityRules($form);

        //check if the security rule is applied at table level
        if ( isset($securityRules[ 'form_' . $form->id ]) ) {
            //check if all the security rules are valid for the model
            if ( !SecurityRuleManager::evaluateSecurityRules($securityRules[ 'form_' . $form->id ]) )
                return false;
        }

        return new ColumnManager(md5(CustomForm::class), $form->id, [
            'rules' => $securityRules,
            'data'  => null,
        ]);
    }
}