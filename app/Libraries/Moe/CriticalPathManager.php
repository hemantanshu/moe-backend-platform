<?php

namespace App\Libraries\Moe;

use App\Models\Moe\ActivityNodeLink;
use App\Models\Moe\PathRoute;
use App\Models\Moe\ProjectActivityNode;
use App\Models\Moe\ProjectPath;
use App\Models\Moe\ProjectSchedule;
use App\Models\Moe\ProjectScheduleDependency;
use Drivezy\LaravelUtility\Library\DateUtil;
use Drivezy\LaravelUtility\Models\LookupValue;

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
     * @var int
     */
    private $startNode = 0;
    /**
     * @var int
     */
    private $endNode = 0;

    /**
     * @var |null
     */
    private $type = null;
    /**
     * @var null
     */
    private $typeId = null;


    /**
     * CriticalPathManager constructor.
     * @param $id
     * @param $typeId
     */
    public function __construct ($id, $typeId = 1111)
    {
        $this->project_id = $id;
        $this->typeId = $typeId;

        $this->type = LookupValue::find($typeId)->value;
    }

    /**
     *
     */
    public function process ()
    {
        $this->fixUpdatedStartTime();
        $this->generateNodes();
        $this->generateLinks();
        $this->setStartEndNode();
        $this->setEarliestDuration();
        $this->setLatestCompletion();
        $this->calculateFloats();
        $this->generatePaths();
    }

    /**
     *
     */
    public function fixUpdatedStartTime ()
    {
        $column = "updated_{$this->type}_start_date";
        $projectSchedules = ProjectSchedule::where('project_id', $this->project_id)->get();
        foreach ( $projectSchedules as $projectSchedule ) {
            $projectSchedule->{$column} = $this->getMaxStartTime($projectSchedule);
            $projectSchedule->save();
        }
    }

    /**
     * @param $projectSchedule
     * @return mixed
     */
    private function getMaxStartTime ($projectSchedule)
    {
        $endDate = "{$this->type}_end_date";
        $startDate = "{$this->type}_start_date";

        $sql = "select max(a.{$endDate}) date from moe_project_schedules a, moe_project_schedule_dependencies b where a.id = b.dependency_id and b.project_schedule_id = {$projectSchedule->id} and b.deleted_at is null";
        $record = sql($sql);
        if ( sizeof($record) && $record[0]->date )
            return $record[0]->date;

        return $projectSchedule->{$startDate};
    }

    /**
     *
     */
    public function generateNodes ()
    {
        ProjectActivityNode::where('project_id', $this->project_id)
            ->where('type_id', $this->typeId)->delete();
        $endDate = "{$this->type}_end_date";

        $projectSchedules = ProjectSchedule::where('project_id', $this->project_id)->get();
        foreach ( $projectSchedules as $projectSchedule ) {
            ProjectActivityNode::create([
                'type_id'             => $this->typeId,
                'project_id'          => $projectSchedule->project_id,
                'project_schedule_id' => $projectSchedule->id,
                'activity_date'       => $projectSchedule->{$endDate},
            ]);
        }
    }

    /**
     *
     */
    public function generateLinks ()
    {
        $startDate = "updated_{$this->type}_start_date";
        $endDate = "{$this->type}_end_date";

        ActivityNodeLink::where('project_id', $this->project_id)->where('type_id', $this->typeId)->delete();

        $projectSchedules = ProjectSchedule::where('project_id', $this->project_id)->get();
        foreach ( $projectSchedules as $projectSchedule ) {

            $dependencies = ProjectScheduleDependency::with('dependency')->where('project_schedule_id', $projectSchedule->id)->get();

            foreach ( $dependencies as $dependency ) {
                $tail = ProjectActivityNode::where('project_schedule_id', $dependency->dependency_id)->where('type_id', $this->typeId)->first();
                $head = ProjectActivityNode::where('project_schedule_id', $dependency->project_schedule_id)->where('type_id', $this->typeId)->first();

                ActivityNodeLink::create([
                    'type_id'      => $this->typeId,
                    'project_id'   => $this->project_id,
                    'tail_node_id' => $tail->id,
                    'head_node_id' => $head->id,
                    'activity_id'  => $projectSchedule->work_activity_id,
                    'duration'     => DateUtil::getDateDifference($projectSchedule->{$startDate}, $projectSchedule->{$endDate}),
                ]);
            }
        }
    }

    /**
     *
     */
    private function setStartEndNode ()
    {
        ProjectActivityNode::where('type_id', $this->typeId)
            ->where('project_id', $this->project_id)->update([
                'earliest_start_duration'    => 0,
                'latest_completion_duration' => 0,
            ]);

        $sql = "select b.id id from moe_project_schedules a, moe_project_activity_nodes b where a.project_id = {$this->project_id} and b.type_id = {$this->typeId} and a.id = b.project_schedule_id and a.work_activity_id = 74 and a.deleted_at is null and b.deleted_at is null";
        $this->startNode = sql($sql)[0]->id;

        $sql = "select b.id id from moe_project_schedules a, moe_project_activity_nodes b where a.project_id = {$this->project_id} and b.type_id = {$this->typeId} and a.id = b.project_schedule_id and a.work_activity_id = 75 and a.deleted_at is null and b.deleted_at is null";
        $this->endNode = sql($sql)[0]->id;

        $node = ProjectActivityNode::find($this->startNode);
        $node->earliest_start_duration = 0;
        $node->latest_completion_duration = 0;
        $node->save();
    }

    /**
     *
     */
    private function setEarliestDuration ()
    {
        for ( $i = 0; $i < 100; ++$i ) {
            $nodes = ProjectActivityNode::where('id', '!=', $this->startNode)->where('earliest_start_duration', 0)->where('project_id', $this->project_id)->where('type_id', $this->typeId)->get();
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

    /**
     * @param $node
     * @return int|mixed|null
     */
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

    /**
     *
     */
    private function setLatestCompletion ()
    {
        $endNode = ProjectActivityNode::find($this->endNode);
        $endNode->latest_completion_duration = $endNode->earliest_start_duration;
        $endNode->save();

        $nodes = ProjectActivityNode::where('id', '!=', $this->startNode)->where('earliest_start_duration', '>', 0)->where('project_id', $this->project_id)->where('type_id', $this->typeId)->where('latest_completion_duration', 0)->orderBy('earliest_start_duration', 'desc')->get();

        if ( !sizeof($nodes) ) return;

        foreach ( $nodes as $node ) {
            $node->latest_completion_duration = $this->getLatestCompletionOfNode($node);
            $node->save();
        }

        ProjectActivityNode::where('project_id', $this->project_id)->where('type_id', $this->typeId)->where('latest_completion_duration', '>', $endNode->latest_completion_duration)->update([
            'latest_completion_duration' => 0,
        ]);

    }

    /**
     * @param $node
     * @return int
     */
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
     *
     */
    private function generatePaths ()
    {
        //cleanup tables before new insertion
        ProjectPath::where('project_id', $this->project_id)->where('type_id', $this->typeId)->delete();
        PathRoute::where('project_id', $this->project_id)->where('type_id', $this->typeId)->delete();

        $break = false;

        $paths[0] = [];
        array_push($paths[0], $this->startNode);

        while ( !$break ) {
            $break = true;
            for ( $i = 0; $i < sizeof($paths); ++$i ) {
                $lastNode = end($paths[ $i ]);

                if ( $lastNode == $this->endNode ) continue;

                $nextNodes = $this->getNextNodeOnPath($lastNode);
                if ( !sizeof($nextNodes) ) continue;

                //create extra paths if there are bifurcations
                for ( $j = 1; $j < sizeof($nextNodes); ++$j ) {
                    $paths[ sizeof($paths) ] = $paths[ $i ];
                    array_push($paths[ sizeof($paths) - 1 ], $nextNodes[ $j ]);
                }

                array_push($paths[ $i ], $nextNodes[0]);
                $break = false;
            }
        }

        return $this->setupPaths($paths);
    }

    /**
     * @param $node
     * @return mixed
     */
    private function getNextNodeOnPath ($node)
    {
        return ActivityNodeLink::where('tail_node_id', $node)->pluck('head_node_id');
    }

    /**
     * @param $paths
     */
    private function setupPaths ($paths)
    {
        foreach ( $paths as $path ) {
            $projectPath = ProjectPath::create([
                'project_id' => $this->project_id,
                'type_id'    => $this->typeId,
            ]);

            $projectPath->name = 'Path#' . $projectPath->id;
            $projectPath->save();

            foreach ( $path as $key => $value ) {
                PathRoute::create([
                    'type_id'    => $this->typeId,
                    'project_id' => $this->project_id,
                    'path_id'    => $projectPath->id,
                    'node_id'    => $value,
                    'order'      => $key,
                ]);
            }
        }
        $this->setAssignCriticalPath();
    }

    //check which one is the critical path

    /**
     *
     */
    private function setAssignCriticalPath ()
    {
        $paths = ProjectPath::where('project_id', $this->project_id)->where('type_id', $this->typeId)->get();
        foreach ( $paths as $path ) {
            if ( !$this->isCriticalPath($path) ) continue;

            $path->is_critical_path = true;
            $path->save();
        }
    }

    /**
     * @param $path
     * @return bool
     */
    private function isCriticalPath ($path)
    {
        $routes = PathRoute::where('path_id', $path->id)->get();
        $previousNode = null;
        foreach ( $routes as $route ) {
            $node = ProjectActivityNode::find($route->node_id);
            if ( $node->earliest_start_duration != $node->latest_completion_duration ) return false;

            if ( $route->node_id == $this->startNode ) {
                $previousNode = $node;
                continue;
            }

            //get the node details
            $link = ActivityNodeLink::where('tail_node_id', $previousNode->id)->where('head_node_id', $node->id)->first();

            $earliestDifference = $node->earliest_start_duration - $previousNode->earliest_start_duration;
            $latestDifference = $node->latest_completion_duration - $previousNode->latest_completion_duration;
            $duration = $link->duration;

            if ( $earliestDifference != $latestDifference || $earliestDifference != $duration ) return false;

            $previousNode = $node;
        }

        return true;
    }

    /**
     *
     */
    private function calculateFloats ()
    {
        $links = ActivityNodeLink::with(['tail_node', 'head_node'])->where('project_id', $this->project_id)->get();
        foreach ( $links as $link ) {
            $totalFloat = $link->head_node->latest_completion_duration - $link->tail_node->earliest_start_duration - $link->duration;
            $freeFloat = $link->head_node->earliest_start_duration - $link->tail_node->earliest_start_duration - $link->duration;

            $link->free_float = $freeFloat;
            $link->total_float = $totalFloat;

            $link->save();
        }
    }
}
