<?php

namespace App\Console\Commands;

use App\Models\Moe\ProjectSchedule;
use Drivezy\LaravelUtility\Library\DateUtil;
use Illuminate\Console\Command;

class CodeFixCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'code:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct ()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle ()
    {
        $records = ProjectSchedule::get();
        foreach ( $records as $record ) {
            if ( $record->estimate_start_date && $record->estimate_end_date ) {
                $days = DateUtil::getDateDifference($record->estimate_start_date, $record->estimate_end_date);
                $record->estimated_duration = $days;
            }

            if ( $record->actual_start_date && $record->actual_end_date ) {
                $days = DateUtil::getDateDifference($record->actual_start_date, $record->actual_end_date);
                $record->actual_duration = $days;
            }
            $record->save();
        }
    }
}
