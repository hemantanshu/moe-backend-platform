<?php

namespace App\Console\Commands;

use App\User;
use Drivezy\LaravelUtility\Models\LookupValue;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        $sql = "select * from moe.sys_users where id > 1";
        $users = DB::select(DB::raw($sql));
        foreach ( $users as $user ) {
            User::create([
                'email'          => $user->email,
                'password'       => $user->password,
                'display_name'   => $user->display_name,
                'contact_number' => $user->contact_number,
            ]);

            echo "created user {$user->email}" . PHP_EOL;

        }


    }
}
