<?php

namespace App\Libraries\Moe;

use App\Models\Moe\ActivityNodeLink;
use App\Models\Moe\ProjectSchedule;
use Drivezy\LaravelUtility\Library\DateUtil;

class ActivityTimelineManager
{
    private $project_id = null;
    private $startNode = null;

    public function __construct ($id)
    {
        $this->project_id = $id;
    }

    public function process ()
    {
        $this->analyzeActivities();
        $this->suggestTimelines();
    }

    private function analyzeActivities ()
    {
        $schedules = ProjectSchedule::where('project_id', $this->project_id)->get();
        foreach ( $schedules as $schedule ) {
            $this->analyzeActivity($schedule);
        }
    }

    private function suggestTimelines ()
    {
        $links = ActivityNodeLink::with(['tail_node', 'head_node'])->where('project_id', $this->project_id)->get();
        foreach ( $links as $link ) {
            $link->lag = DateUtil::getDateDifference($link->tail_node->estimate_end_date, $link->head_node->estimate_start_date);
            $link->save();
        }
        $this->calculateSuggestedTimelines();
    }

    private function calculateSuggestedTimelines ()
    {
        $sql = "select b.id id from moe_project_schedules a, moe_project_activity_nodes b where a.project_id = {$this->project_id} and a.id = b.project_schedule_id and a.work_activity_id = 74 and a.deleted_at is null and b.deleted_at is null";
        $this->startNode = sql($sql)[0]->id;

        $startNode = ProjectSchedule::find($this->startNode);
        $startNode->suggested_start_date = $startNode->estimated_start_date;
        $startNode->suggested_end_date = DateUtil::getFutureDate($startNode->mean_avg, $startNode->estimated_start_date);
        $startNode->save();

        $this->setTimelinesForConnectedNodes($startNode);
    }

    private function setTimelinesForConnectedNodes ($node)
    {
        $this->setTimelineForNode($node);
        $links = ActivityNodeLink::where('tail_node_id', $node->id)->get();
        foreach ( $links as $link ) {
            $this->setTimelineForNode(ProjectSchedule::find($link->head_node_id));
        }
    }

    private function setTimelineForNode ($node)
    {
        $query = "select a.* from moe_activity_node_links a, moe_project_schedules b, (select max(b.estimate_end_date) max_date from moe_activity_node_links a, moe_project_schedules b where a.head_node_id = {$node->id} and b.id = a.tail_node_id and a.deleted_at is null) c where a.head_node_id = {$node->id} and b.id = a.tail_node_id and a.deleted_at is null and c.max_date = b.estimate_end_date";
        $record = sql($query)[0];

        $activity = ProjectSchedule::find($record->tail_node_id);

        $node->suggested_start_date = DateUtil::getFutureDate($record->lag, $activity->suggested_end_date);
        $node->suggested_end_date = DateUtil::getFutureDate($node->mean_avg, $node->suggested_start_date);
        $node->save();
    }

    private function analyzeActivity ($schedule)
    {
        $query = "select min(percentage) min, max(percentage) max, avg(percentage) avg, stddev(percentage) sigma from (select (aa.actual - aa.estimate) * 100/ aa.estimate percentage from (select DATEDIFF(estimate_end_date, estimate_start_date) estimate, datediff(actual_end_date, actual_start_date) actual from moe_project_schedules a where work_activity_id = {$schedule->work_activity_id} and a.deleted_at is null and a.actual_start_date is not null and a.actual_end_date is not null and a.estimate_start_date is not null and a.estimate_end_date is not null) aa) aaa";

        $data = sql($query)[0];

        $duration = DateUtil::getDateDifference($schedule->actual_start_date, $schedule->actual_end_date);

        $avg = ( 600 + $data->min + $data->max ) * $duration / 600;
        $sigma = pow(( $data->max - $data->min ) / 6, 2);

        $data = [
            'optimistic_duration'  => floor($duration + $data->min),
            'pessimistic_duration' => ceil($duration + $data->max),
            'mean_factor_1'        => $avg,
            'sigma_factor_1'       => $sigma,
            'mean_factor_2'        => $data->avg,
            'sigma_factor_2'       => $data->sigma,
            'mean_avg'             => ceil(( $avg + $data->avg ) / 2),
            'sigma_avg'            => ceil(( $sigma + $data->sigma ) / 2),
        ];
        foreach ( $data as $key => $value )
            $schedule->{$key} = $value;

        $schedule->suggested_duration = $duration + $data['mean_avg'];

        $schedule->save();
    }

}
