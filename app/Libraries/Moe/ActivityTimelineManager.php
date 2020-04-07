<?php

namespace App\Libraries\Moe;

use App\Models\Moe\ActivityNodeLink;
use App\Models\Moe\ProjectActivityNode;
use App\Models\Moe\ProjectSchedule;
use Drivezy\LaravelUtility\Library\DateUtil;

/**
 * Class ActivityTimelineManager
 * @package App\Libraries\Moe
 */
class ActivityTimelineManager
{
    /**
     * @var null
     */
    private $project_id = null;

    /**
     * ActivityTimelineManager constructor.
     * @param $id
     */
    public function __construct ($id)
    {
        $this->project_id = $id;
    }

    /**
     *
     */
    public function process ()
    {
        $this->analyzeActivities();
        $this->suggestTimelines();
    }

    /**
     *
     */
    private function analyzeActivities ()
    {
        $schedules = ProjectSchedule::where('project_id', $this->project_id)->get();
        foreach ( $schedules as $schedule ) {
            $this->analyzeActivity($schedule);
        }
    }

    /**
     *
     */
    private function suggestTimelines ()
    {
        $links = ActivityNodeLink::with(['tail_node.project_schedule', 'head_node.project_schedule'])->where('project_id', $this->project_id)->where('type_id', 1111)->get();
        foreach ( $links as $link ) {
            $link->lag = DateUtil::getDateDifference($link->tail_node->project_schedule->estimate_end_date, $link->head_node->project_schedule->estimate_start_date);
            $link->save();
        }
        $this->calculateSuggestedTimelines();
    }

    /**
     *
     */
    private function calculateSuggestedTimelines ()
    {
        $projectSchedule = ProjectSchedule::where('project_id', $this->project_id)->where('work_activity_id', 74)->first();

        $this->setSuggestedTimeline($projectSchedule);
    }

    /**
     * @param $schedule
     */
    private function setSuggestedTimeline ($schedule)
    {
        //find the node id
        $node = ProjectActivityNode::where('type_id', 1111)->where('project_schedule_id', $schedule->id)->first();
        $maxPreviousActivity = $this->getMaxActivitySchedule($node->id);

        $schedule->suggested_start_date = $maxPreviousActivity ? $maxPreviousActivity->suggested_end_date : $schedule->estimate_start_date;
        $schedule->suggested_end_date = DateUtil::getFutureDate($schedule->mean_avg, $schedule->suggested_start_date);
        $schedule->save();

        //process forward nodes
        $links = ActivityNodeLink::with('head_node')->where('tail_node_id', $node->id)->get();
        foreach ( $links as $link ) {
            $this->setSuggestedTimeline(ProjectSchedule::find($link->head_node->project_schedule_id));
        }
    }

    /**
     * @param $nodeId
     * @return bool
     */
    private function getMaxActivitySchedule ($nodeId)
    {
        $query = "select c.id from moe_activity_node_links a, moe_project_activity_nodes b, moe_project_schedules c where a.head_node_id = {$nodeId} and a.tail_node_id = b.id and b.project_schedule_id = c.id and a.type_id = 1111 order by c.estimate_end_date desc limit 1";
        $record = sql($query);

        return sizeof($record) ? ProjectSchedule::find($record[0]->id) : false;
    }


    /**
     * @param $schedule
     */
    private function analyzeActivity ($schedule)
    {
        $query = "select min(percentage) min, max(percentage) max, avg(percentage) avg, stddev(percentage) sigma from (select (aa.actual - aa.estimate) * 100/ aa.estimate percentage from (select DATEDIFF(estimate_end_date, estimate_start_date) estimate, datediff(actual_end_date, actual_start_date) actual from moe_project_schedules a where work_activity_id = {$schedule->work_activity_id} and a.deleted_at is null and a.actual_start_date is not null and a.actual_end_date is not null and a.estimate_start_date is not null and a.estimate_end_date is not null) aa) aaa";

        $data = sql($query)[0];

        $tm = DateUtil::getDateDifference($schedule->estimate_start_date, $schedule->estimate_end_date);
        $ta = $tm * ( 1 + 0.01 * $data->min );
        $tb = $tm * ( 1 + 0.01 * $data->max );

        $average_1 = ( $ta + 4 * $tm + $tb ) / 6;
        $sigma_1 = ( $tb - $ta ) / 6;

        $average_2 = $tm * 0.01 * ( $data->avg + 100 ) ?? 0;
        $sigma_2 = $tm * $data->sigma / 100 ?? 0;

        $record = [
            'optimistic_duration'  => floor($ta),
            'pessimistic_duration' => ceil($tb),
            'mean_factor_1'        => $average_1,
            'sigma_factor_1'       => $sigma_1,
            'mean_factor_2'        => $average_2,
            'sigma_factor_2'       => $sigma_2,
            'mean_avg'             => ( $average_2 + $average_1 ) / 2,
            'sigma_avg'            => ( $sigma_2 + $sigma_1 ) / 2,

        ];
        foreach ( $record as $key => $value )
            $schedule->{$key} = $value;

        $schedule->suggested_duration = $tm + $record['mean_avg'];

        $schedule->save();
    }

}
