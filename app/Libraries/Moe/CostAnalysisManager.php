<?php

namespace App\Libraries\Moe;

use App\Models\Moe\CostHead;
use App\Models\Moe\ProjectCost;
use Drivezy\LaravelUtility\LaravelUtility;

/**
 * Class CostAnalysisManager
 * @package App\Libraries\Moe
 */
class CostAnalysisManager
{
    private $min_counter = 3;

    public function process ()
    {
        $this->min_counter = LaravelUtility::getProperty('cost.min.data.calculation', 3);
        $this->processCosts();
    }

    private function processCosts ()
    {
        CostHead::where('id', '>', 0)->update(['m_slope' => 0, 'c_y_intercept' => 0, 'co_relation' => 0]);

        $costs = CostHead::get();
        foreach ( $costs as $cost ) {
            $equation = $this->processCost($cost);
            ProjectCost::where('cost_head_id', $cost->id)->update([
                'equation' => $equation,
            ]);
            $this->setAverageCost($cost);
            $this->setEquatedCost(( $cost->id ));

            $cost->equation = $equation;
            $cost->save();
        }
    }

    private function processCost ($cost)
    {
        $sql = "select actual_cost x, (actual_cost - estimate_cost) y from moe_project_costs where deleted_at is null and actual_cost is not null and estimate_cost is not null and cost_head_id = {$cost->id}";

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

        if ( $m1 * $m2 == 0 ) return null;

        $r = ( $n * $sum['xy'] - $sum['x'] * $sum['y'] ) / ( sqrt($m1 * $m2) );

        $cost->m_slope = $m;
        $cost->c_y_intercept = $c;
        $cost->co_relation = $r;
        $cost->save();

        $m = round($m, 3);
        $c = round($c, 3);

        $operator = $c > 0 ? '+' : '';

        return "y={$m}x{$operator}{$c}";
    }

    private function setAverageCost ($cost)
    {
        $sql = "select avg((actual_cost - estimate_cost) / actual_cost) avg from moe_project_costs where deleted_at is null and cost_head_id = {$cost->id}";

        $record = sql($sql);
        if ( !sizeof($record) ) return;

        $avg = $record[0]->avg;

        //get all project cost heads
        $records = ProjectCost::where('cost_head_id', $cost->id)->get();
        foreach ( $records as $record ) {
            $record->suggested_cost = ( 1 + $avg ) * $record->estimate_cost;
            $record->save();
        }
    }

    private function setEquatedCost ($costId)
    {
        $cost = CostHead::find($costId);
        $projectCosts = ProjectCost::where('cost_head_id', $costId)->get();
        foreach ( $projectCosts as $projectCost ) {
            $projectCost->equated_cost = $projectCost->estimate_cost + $cost->m_slope * $projectCost->estimate_cost + $cost->c_y_intercept;
            $projectCost->save();
        }
    }
}
