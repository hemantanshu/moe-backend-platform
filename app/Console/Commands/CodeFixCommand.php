<?php

namespace App\Console\Commands;

use App\Models\Moe\ProjectSchedule;
use App\Models\Moe\WorkActivity;
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
        $activities = WorkActivity::get();
        foreach ( $activities as $activity ) {
            ProjectSchedule::where('work_activity_id', $activity->id)->update(['name' => $activity->name]);
        }
    }
}
