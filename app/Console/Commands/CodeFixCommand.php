<?php

namespace App\Console\Commands;

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
        $lookupTypes = [152 => 101, 145 => 102, 146 => 103, 147 => 104];
        foreach ( $lookupTypes as $key => $value ) {
            $sql = "select * from moe.utl_lookup_values where lookup_type = {$key}";
            $records = DB::select(DB::raw($sql));

            foreach ( $records as $record ) {
                $lookupValue = LookupValue::create([
                    'lookup_type_id' => $value,
                    'name'           => $record->name,
                    'value'          => $record->value,
                    'description'    => $record->description,
                ]);

                DB::update("update moe.utl_lookup_values set new_id = $lookupValue->id where id = $record->id");
            }
        }

    }
}
