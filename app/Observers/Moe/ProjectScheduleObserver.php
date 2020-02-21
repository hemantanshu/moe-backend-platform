<?php

namespace App\Observers\Moe;

use App\Models\Moe\ProjectSchedule;
use Drivezy\LaravelUtility\Library\Message;
use Drivezy\LaravelUtility\Observers\BaseObserver;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class ProjectScheduleObserver
 * @package App\Observers\Moe
 */
class ProjectScheduleObserver extends BaseObserver
{

    /**
     * @var array
     */
    protected $rules = [
    ];

    /**
     * @param Eloquent $model
     * @return bool|Eloquent
     */
    public function saving (Eloquent $model)
    {
        //check for duplicate record
        $record = ProjectSchedule::where('project_id', $model->project_id)->where('work_activity_id', $model->work_activity_id)->first();
        if ( $record && $record->id != $model->id ) {
            Message::warn('Duplicate project activity..');

            return $model;
        }

        return parent::saving($model); // TODO: Change the autogenerated stub
    }

}
