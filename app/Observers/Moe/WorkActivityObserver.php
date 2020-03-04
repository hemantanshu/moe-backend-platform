<?php

namespace App\Observers\Moe;

use App\Models\Moe\ProjectSchedule;
use Drivezy\LaravelUtility\Observers\BaseObserver;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class WorkScheduleObserver
 * @package App\Observers\Moe
 */
class WorkActivityObserver extends BaseObserver
{

    /**
     * @var array
     */
    protected $rules = [
    ];

    /**
     * @param Eloquent $model
     */
    public function saved (Eloquent $model)
    {
        parent::saved($model);

        //save the name of work activity on all assignments
        if ( $model->getOriginal('name') != $model->name ) {
            ProjectSchedule::where('work_activity_id', $model->id)->update(['name' => $model->name]);
        }
    }
}
