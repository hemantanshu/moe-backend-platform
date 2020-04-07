<?php

namespace App\Console\Commands;

use App\Libraries\Moe\ActivityDelayAnalysisManager;
use App\Libraries\Moe\ActivityTimelineManager;
use App\Libraries\Moe\CriticalPathManager;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        ( new ActivityDelayAnalysisManager() )->process();
    }
}
