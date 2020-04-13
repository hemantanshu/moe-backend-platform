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
class EquatedTimelineManager
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
        $this->calculateSuggestedTimelines();
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

        $maxPreviousRecord = $this->getMaxActivitySchedule($node->id);
        if ( $maxPreviousRecord ) {
            $maxPreviousActivity = ProjectSchedule::find($maxPreviousRecord->id);
            $schedule->equated_suggested_start_date = DateUtil::getFutureDate($maxPreviousRecord->lags, $maxPreviousActivity->equated_suggested_end_date);
        } else
            $schedule->equated_suggested_start_date = $schedule->estimate_start_date;


        $schedule->suggested_end_date = DateUtil::getFutureDate($schedule->equated_suggested_duration, $schedule->equated_suggested_start_date);

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
        $query = "select a.lag lags, c.id id from moe_activity_node_links a, moe_project_activity_nodes b, moe_project_schedules c where a.head_node_id = {$nodeId} and a.tail_node_id = b.id and b.project_schedule_id = c.id and a.type_id = 1111 order by c.equated_suggested_end_date desc limit 1";
        $record = sql($query);

        return sizeof($record) ? $record[0] : false;
    }


    /**
     * @param $schedule
     */
    private function analyzeActivity ($schedule)
    {
        $duration = DateUtil::getDateDifference($schedule->estimate_start_date, $schedule->estimate_end_date);
        $duration += $schedule->equation ? $this->getDelay($schedule, $duration) : 0;

        $schedule->equated_suggested_duration = $duration;
        $schedule->save();

    }

    private function getDelay ($schedule, $duration)
    {
        $activity = $schedule->work_activity;

        return $activity->m_slope * $duration + $activity->c_y_intercept;
    }

}
