<?php


namespace App\Libraries\Moe;


use App\Models\Moe\ProjectSchedule;
use App\Models\Moe\WorkActivity;

/**
 * Class ActivityDelayAnalysisManager
 * @package App\Libraries\Moe
 */
class ActivityDelayAnalysisManager
{
    /**
     *
     */
    public function process ()
    {
        $this->getActivities();
    }

    /**
     *
     */
    private function getActivities ()
    {
        $activities = WorkActivity::get();
        foreach ( $activities as $activity ) {
            $activity->update(['m_slope' => 0, 'c_y_intercept' => 0]);

            $equation = $this->processActivity($activity);

            ProjectSchedule::where('work_activity_id', $activity->id)->update([
                'equation' => $equation,
            ]);
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

        if ( $n < 2 ) return null;

        $sum = [
            'xy' => 0,
            'x'  => 0,
            'xx' => 0,
            'y'  => 0,
        ];
        foreach ( $records as $record ) {
            $x = intval($record->x);
            $y = intval($record->y);

            $sum['xy'] += $x * $y;
            $sum['x'] += $x;
            $sum['y'] += $y;
            $sum['xx'] += $x * $x;
        }

        $denominator = $n * $sum['xx'] - $sum['x'] * $sum['x'];
        if ( $denominator == 0 ) return null;

        $m = $n * ( $sum['xy'] - $sum['x'] * $sum['y'] ) / ( $denominator );
        $c = ( $sum['y'] - $m * $sum['x'] ) / ( $n );

        $activity->m_slope = $m;
        $activity->c_y_intercept = $c;
        $activity->save();

        $m = round($m, 3);
        $c = round($c, 3);

        return "y={$m}x+{$c}";

    }
}
