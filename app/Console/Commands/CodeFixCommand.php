<?php

namespace App\Console\Commands;

use App\Libraries\Moe\ActivityTimelineManager;
use App\Libraries\Moe\CriticalPathManager;
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
//        ( new CriticalPathManager(40) )->fixUpdatedStartTime();
//        ( new CriticalPathManager(40) )->generateNodes();
//        ( new CriticalPathManager(40) )->generateLinks();
//        ( new ActivityTimelineManager(40) )->process();

//        ( new CriticalPathManager(40, 1111) )->process();
        ( new CriticalPathManager(40, 1112) )->process();
    }
}
