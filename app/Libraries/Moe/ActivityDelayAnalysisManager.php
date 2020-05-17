<?php

namespace App\Libraries\Moe;

use App\Models\Moe\ProjectSchedule;
use App\Models\Moe\WorkActivity;
use Drivezy\LaravelUtility\LaravelUtility;

/**
 * Class ActivityDelayAnalysisManager
 * @package App\Libraries\Moe
 */
class ActivityDelayAnalysisManager
{
    private $min_counter = 3;

    /**
     *
     */
    public function process ()
    {
        $this->min_counter = LaravelUtility::getProperty('activity.min.data.calculation', 3);
        $this->getActivities();
    }

    /**
     *
     */
    private function getActivities ()
    {
        WorkActivity::where('id', '>', 0)->update(['m_slope' => 0, 'c_y_intercept' => 0, 'co_relation' => 0]);

        $activities = WorkActivity::get();
        foreach ( $activities as $activity ) {

            $equation = $this->processActivity($activity);

            ProjectSchedule::where('work_activity_id', $activity->id)->update([
                'equation' => $equation,
            ]);

            $activity->equation = $equation;
            $activity->save();
        }
    }

    /**
     * @param $activity
     * @return string|null
     */
    private function processActivity ($activity)
    {
        $sql = "select actual_duration x, (actual_duration - estimated_duration) y from moe_project_schedules where deleted_at is null and actual_end_date is not null and actual_start_date is not null and work_activity_id = {$activity->id}";

        $records = sql($sql);
        $n = sizeof($records);

        if ( $n <= $this->min_counter ) return null;

        $sum = [
            'xy' => 0,
            'x'  => 0,
            'xx' => 0,
            'y'  => 0,
            'yy' => 0,
        ];
        foreach ( $records as $record ) {
            $x = intval($record->x);
            $y = intval($record->y);

            $sum['xy'] += $x * $y;
            $sum['x'] += $x;
            $sum['y'] += $y;
            $sum['yy'] += $y * $y;
            $sum['xx'] += $x * $x;
        }

        $denominator = $n * $sum['xx'] - $sum['x'] * $sum['x'];
        if ( $denominator == 0 ) return null;

        $m = ( $n * $sum['xy'] - $sum['x'] * $sum['y'] ) / ( $denominator );
        $c = round(( $sum['y'] - $m * $sum['x'] ) / ( $n ));

        //regression calculation
        $m1 = $n * $sum['xx'] - $sum['x'] * $sum['x'];
        $m2 = $n * $sum['yy'] - $sum['y'] * $sum['y'];

        $r = ( $n * $sum['xy'] - $sum['x'] * $sum['y'] ) / ( sqrt($m1 * $m2) );

        $activity->m_slope = $m;
        $activity->c_y_intercept = $c;
        $activity->co_relation = $r;
        $activity->save();

        $m = round($m, 3);
        $c = round($c, 3);

        $operator = $c > 0 ? '+' : '';

        return "y={$m}x{$operator}{$c}";
    }
}
