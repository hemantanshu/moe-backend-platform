<?php

namespace App\Libraries\Moe;

use App\Models\Moe\ActivityNodeLink;
use App\Models\Moe\ProjectActivityNode;
use App\Models\Moe\ProjectSchedule;
use App\Models\Moe\ProjectScheduleDependency;
use Drivezy\LaravelUtility\Library\DateUtil;

/**
 * Class CriticalPathManager
 * @package App\Libraries\Moe
 */
class CriticalPathManager
{
    /**
     * @var null
     */
    private $project_id = null;

    /**
     * CriticalPathManager constructor.
     * @param $id
     */
    public function __construct ($id)
    {
        $this->project_id = $id;
    }

    public function process ()
    {
        $this->fixUpdatedStartTime();
        $this->generateNodes();
        $this->generateLinks();

    }

    /**
     *
     */
    private function fixUpdatedStartTime ()
    {
        $projectSchedules = ProjectSchedule::where('project_id', $this->project_id)->get();
        foreach ( $projectSchedules as $projectSchedule ) {
            $projectSchedule->updated_estimate_start_date = $this->getMaxStartTime($projectSchedule);
            $projectSchedule->save();
        }
    }

    private function generateNodes ()
    {
        ProjectActivityNode::where('project_id', $this->project_id)->delete();

        $projectSchedules = ProjectSchedule::where('project_id', $this->project_id)->get();
        foreach ( $projectSchedules as $projectSchedule ) {
            ProjectActivityNode::create([
                'project_id'          => $projectSchedule->project_id,
                'project_schedule_id' => $projectSchedule->id,
                'activity_date'       => $projectSchedule->estimate_end_date,
            ]);
        }
    }

    private function generateLinks ()
    {
        ActivityNodeLink::where('project_id', $this->project_id)->delete();

        $projectSchedules = ProjectSchedule::where('project_id', $this->project_id)->get();
        foreach ( $projectSchedules as $projectSchedule ) {

            $dependencies = ProjectScheduleDependency::with('dependency')->where('project_schedule_id', $projectSchedule->id)->get();

            foreach ( $dependencies as $dependency ) {

                if ( DateUtil::getDateTimeDifference($dependency->dependency->estimate_end_date, $projectSchedule->updated_estimate_start_date) != 0 ) continue;

                $tail = ProjectActivityNode::where('project_schedule_id', $dependency->dependency_id)->first();
                $head = ProjectActivityNode::where('project_schedule_id', $dependency->project_schedule_id)->first();

                ActivityNodeLink::create([
                    'project_id'   => $this->project_id,
                    'tail_node_id' => $tail->id,
                    'head_node_id' => $head->id,
                    'activity_id'  => $projectSchedule->work_activity_id,
                    'duration'     => DateUtil::getDateDifference($projectSchedule->updated_estimate_start_date, $projectSchedule->estimate_end_date),
                ]);


            }
        }
    }

    /**
     * @param $projectSchedule
     * @return mixed
     */
    private function getMaxStartTime ($projectSchedule)
    {
        $sql = "select max(a.estimate_end_date) date from moe_project_schedules a, moe_project_schedule_dependencies b where a.id = b.dependency_id and b.project_schedule_id = {$projectSchedule->id} and b.deleted_at is null";
        $record = sql($sql);
        if ( sizeof($record) && $record[0]->date )
            return $record[0]->date;

        return $projectSchedule->estimate_end_date;
    }
}
