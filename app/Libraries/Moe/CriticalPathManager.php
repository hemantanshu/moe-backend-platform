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
    private $startNode = 0;
    private $endNode = 0;
    private $nodes = [];

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
        $this->setStartEndNode();
        $this->setEarliestDuration();
        $this->setLatestCompletion();

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

    private function setStartEndNode ()
    {
        ProjectActivityNode::where('project_id', $this->project_id)->update([
            'earliest_start_duration'    => 0,
            'latest_completion_duration' => 0,
        ]);

        $sql = "select b.id id from moe_project_schedules a, moe_project_activity_nodes b where a.project_id = {$this->project_id} and a.id = b.project_schedule_id and a.work_activity_id = 74 and a.deleted_at is null and b.deleted_at is null";
        $this->startNode = sql($sql)[0]->id;

        $sql = "select b.id id from moe_project_schedules a, moe_project_activity_nodes b where a.project_id = {$this->project_id} and a.id = b.project_schedule_id and a.work_activity_id = 75 and a.deleted_at is null and b.deleted_at is null";
        $this->endNode = sql($sql)[0]->id;

        $node = ProjectActivityNode::find($this->startNode);
        $node->earliest_start_duration = 0;
        $node->latest_completion_duration = 0;
        $node->save();
    }

    private function setEarliestDuration ()
    {
        for ( $i = 0; $i < 100; ++$i ) {
            $nodes = ProjectActivityNode::where('id', '!=', $this->startNode)->where('earliest_start_duration', 0)->where('project_id', $this->project_id)->get();
            if ( !sizeof($nodes) ) return;

            foreach ( $nodes as $node ) {
                if ( $node->id == $this->startNode || $node->earliest_start_duration > 0 ) continue;

                $duration = $this->getEarliestDurationOfNode($node);
                if ( is_null($duration) ) continue;

                $node->earliest_start_duration = $duration;
                $node->save();
            }
        }
    }

    private function getEarliestDurationOfNode ($node)
    {
        $max = 0;
        //find all tails against this head
        $records = ActivityNodeLink::with('tail_node')->where('head_node_id', $node->id)->get();
        foreach ( $records as $record ) {
            if ( $record->tail_node_id != $this->startNode && $record->tail_node->earliest_start_duration == 0 )
                return null;

            $sum = $record->tail_node->earliest_start_duration + $record->duration;
            $max = $sum > $max ? $sum : $max;
        }

        return $max;
    }

    private function setLatestCompletion ()
    {
        $endNode = ProjectActivityNode::find($this->endNode);
        $endNode->latest_completion_duration = $endNode->earliest_start_duration;
        $endNode->save();

        $nodes = ProjectActivityNode::where('id', '!=', $this->startNode)->where('earliest_start_duration', '>', 0)->where('project_id', $this->project_id)->where('latest_completion_duration', 0)->orderBy('earliest_start_duration', 'desc')->get();

        if ( !sizeof($nodes) ) return;

        foreach ( $nodes as $node ) {
            $node->latest_completion_duration = $this->getLatestCompletionOfNode($node);
            $node->save();
        }

        ProjectActivityNode::where('project_id', $this->project_id)->where('latest_completion_duration', '>', $endNode->latest_completion_duration)->update([
            'latest_completion_duration' => 0,
        ]);

    }

    private function getLatestCompletionOfNode ($node)
    {
        $min = 100000000;
        //find all tails against this head
        $records = ActivityNodeLink::where('tail_node_id', $node->id)->get();
        foreach ( $records as $record ) {
            $diff = $record->head_node->latest_completion_duration - $record->duration;
            $min = $diff < $min ? $diff : $min;
        }

        return $min;
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

        return $projectSchedule->estimate_start_date;
    }
}
