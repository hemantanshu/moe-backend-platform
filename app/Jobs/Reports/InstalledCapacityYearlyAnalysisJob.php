<?php


namespace App\Jobs\Reports;


use App\Models\Report\ReportProjectAnalysis;
use Drivezy\LaravelUtility\Job\BaseJob;

class InstalledCapacityYearlyAnalysisJob extends BaseJob
{
    public function handle ()
    {
        parent::handle();

        ReportProjectAnalysis::where('id', '!=', 0)->delete();

        $minYear = $this->getMinYear();
        $maxYear = $this->getMaxYear();

        $records = [];
        for ( $i = $minYear; $i <= $maxYear; ++$i ) {
            $records[ $i ] = [
                'actual_installed_capacity'               => $this->getInstalledCapacityForTheYear($i),
                'actual_cumulative_installed_capacity'    => $this->getCumulativeCapacityForTheYear($i),
                'estimated_installed_capacity'            => $this->getInstalledEstimateForTheYear($i),
                'estimated_cumulative_installed_capacity' => $this->getCumulativeEstimateForTheYear($i),
            ];
        }

        foreach ( $records as $key => $value ) {
            $rpt = new ReportProjectAnalysis();
            $rpt->year = $key;
            foreach ( $value as $k => $v ) {
                $rpt->{$k} = $v;
            }

            $rpt->save();
        }

    }

    private function getMinYear ()
    {
        $sql = sql("select min(year(cod)) year from moe_project_details");

        return $sql[0]->year;
    }

    private function getMaxYear ()
    {
        $sql = sql("select max(year(cod)) year from moe_project_details");

        return $sql[0]->year;
    }

    private function getInstalledCapacityForTheYear ($year)
    {
        $record = "select sum(installed_capacity) installed_capacity from moe_project_details where year(cod) = {$year}";
        $record = sql($record);

        if ( sizeof($record) )
            return $record[0]->installed_capacity + 0;

        return 0;
    }

    private function getCumulativeCapacityForTheYear ($year)
    {
        $record = "select sum(installed_capacity) installed_capacity from moe_project_details where year(cod) <= {$year}";
        $record = sql($record);

        if ( sizeof($record) )
            return $record[0]->installed_capacity + 0;

        return 0;
    }

    private function getInstalledEstimateForTheYear ($year)
    {
        $record = sql("select sum(a.installed_capacity) installed_capacity from moe_project_details a, moe_project_schedules b where a.id = b.project_id and b.deleted_at is null and b.work_activity_id = 75 and year(b.estimate_start_date) = {$year}");

        if ( sizeof($record) )
            return $record[0]->installed_capacity + 0;

        return 0;
    }

    private function getCumulativeEstimateForTheYear ($year)
    {
        $record = sql("select sum(a.installed_capacity) installed_capacity from moe_project_details a, moe_project_schedules b where a.id = b.project_id and b.deleted_at is null and b.work_activity_id = 75 and year(b.estimate_start_date) <= {$year}");

        if ( sizeof($record) )
            return $record[0]->installed_capacity + 0;

        return 0;
    }
}
