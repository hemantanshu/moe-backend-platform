<?php

namespace App\Console\Commands;

use App\Libraries\Moe\ActivityDelayAnalysisManager;
use App\Libraries\Moe\ActivityTimelineManager;
use App\Libraries\Moe\CostAnalysisManager;
use App\Libraries\Moe\CriticalPathManager;
use App\Libraries\Moe\EquatedTimelineManager;
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
        $projectId = 50;

        ( new CriticalPathManager($projectId, 1111) )->process();
        ( new ActivityTimelineManager($projectId) )->process();
        ( new EquatedTimelineManager($projectId) )->process();
        ( new CriticalPathManager($projectId, 1112) )->process();
        ( new CriticalPathManager($projectId, 1125) )->process();
    }
}
