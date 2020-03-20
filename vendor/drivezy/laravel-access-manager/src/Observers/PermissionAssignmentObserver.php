<?php

namespace Drivezy\LaravelAccessManager\Observers;

use Drivezy\LaravelAccessManager\Models\PermissionAssignment;
use Drivezy\LaravelAccessManager\Models\UserGroup;
use Drivezy\LaravelAccessManager\Models\UserGroupMember;
use Drivezy\LaravelUtility\LaravelUtility;
use Drivezy\LaravelUtility\Observers\BaseObserver;
use Illuminate\Database\Eloquent\Model as Eloquent;

class PermissionAssignmentObserver extends BaseObserver
{
    protected $rules = [
        'source_type'   => 'required',
        'source_id'     => 'required',
        'permission_id' => 'required',
    ];

    public function created (Eloquent $model)
    {
        parent::created($model);

        if ( $model->source_type == md5(UserGroup::class) )
            self::attachPermissionToGroup($model);
    }

    /**
     * @param Eloquent $model
     */
    private function attachPermissionToGroup (Eloquent $model)
    {
        $members = UserGroupMember::where('user_group_id', $model->source_id)->get();
        foreach ( $members as $member ) {
            PermissionAssignment::create([
                'source_type'   => md5(LaravelUtility::getUserModelFullQualifiedName()),
                'source_id'     => $member->user_id,
                'target_type'   => md5(UserGroup::class),
                'target_id'     => $model->source_id,
                'permission_id' => $model->permission_id,
            ]);
        }
    }

    public function deleted (Eloquent $model)
    {
        parent::deleted($model);

        self::removeAssociatedPermissions($model);
    }

    /**
     * @param Eloquent $model
     * @return bool
     */
    private function removeAssociatedPermissions (Eloquent $model)
    {
        if ( $model->source_type == md5(LaravelUtility::getUserModelFullQualifiedName()) ) return false;

        PermissionAssignment::where('target_type', $model->source_type)->where('target_id', $model->source_id)
            ->where('permission_id', $model->permission_id)
            ->delete();
    }
}
