<?php

namespace mcriver\Console\Commands;

use Illuminate\Console\Command;
use mcriver\User;

class Import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from old csv files.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        set_time_limit(30*60); // 30 Mins
        ini_set('memory_limit', '1024M');
        $this->info("Begin Loading Old Users");
        $counter='';

        if (($handle = fopen(url('/')."/data/old/people.csv", "r")) !== FALSE) {
            if(($data = fgetcsv($handle, null, ",")) !== FALSE) {
                $num = count($data);
                $this->info("people.csv ".$num." columns\n");
            }
            $counter = 0;
            while (($data = fgetcsv($handle, null, ",")) !== FALSE) {  
                $counter++;
                if(count($data)!=$num)
                {
                    $this->info($counter.': column # mismatch '.count($data)."\n");
                } else {
                    $user = User::where('email','=',$data[11])->first();
                    if(empty($user))
                    {
                        $user = new User;
                        $user->name = $data[4];
                        $user->email = $data[11];
                        $user->save();
                    }
                }
            }
        }
    }
}
