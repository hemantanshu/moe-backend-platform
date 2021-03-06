<?php

namespace App\Console\Commands;

use App\Jobs\Reports\InstalledCapacityYearlyAnalysisJob;
use App\Libraries\Moe\ActivityDelayAnalysisManager;
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
        (new InstalledCapacityYearlyAnalysisJob())->handle();
    }
}
