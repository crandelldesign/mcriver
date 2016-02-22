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

        // Check if Jim McDonald is in the Database
        $user = User::where('email','=','jmcd333@comcast.net')->first();
        if(empty($user)) {
            $user = new User;
            $user->name = 'Jim McDonald';
            $user->email = 'jmcd333@comcast.net';
            $user->phone = '248-310-4923';
            $user->save();
            $this->info("Loaded Jim McDonald\n");
        }
        // Check if Matt Crandell is in the Database
        $user = User::where('email','=','mrcrandell@gmail.com')->first();
        if(empty($user)) {
            $user = new User;
            $user->name = 'Matt Crandell';
            $user->email = 'mrcrandell@gmail.com';
            $user->phone = '248-240-1642';
            $user->save();
            $this->info("Loaded Matt Crandell\n");
        }
        /*if (($handle = fopen(url('/')."/data/old/people.csv", "r")) !== FALSE) {
            if(($data = fgetcsv($handle, null, ",")) !== FALSE) {
                $num = count($data);
                $this->info("people.csv ".$num." columns\n");
            }
            $counter = 0;
            while (($data = fgetcsv($handle, null, ",")) !== FALSE) {  
                $counter++;
                if(count($data)!=$num) {
                    $this->info($counter.': column # mismatch '.count($data)."\n");
                } else {
                    $user = User::where('email','=',$data[11])->first();
                    if(empty($user) && $data[11] != '') {
                        $user = new User;
                        $user->name = $data[4];
                        $user->email = $data[11];
                        $user->phone = $data[12];
                        $user->save();
                    }
                }
            }
            fclose($handle);
        }
        $this->info("Loaded $counter Old Users\n");*/
        $this->info("Begin Linking Admins");
        if (($handle = fopen(public_path()."/data/old/users.csv", "r")) !== FALSE) {
            if(($data = fgetcsv($handle, null, ",")) !== FALSE) {
                $num = count($data);
                $this->info("users.csv ".$num." columns\n");
            }
            $counter = 0;
            while (($data = fgetcsv($handle, null, ",")) !== FALSE) {
                $counter++;
                if(count($data)!=$num) {
                    $this->info($counter.': column # mismatch '.count($data)."\n");
                } else {
                    $user = User::where('email','=',$data[7])->first();
                    if(!empty($user)) {
                        $user->password = $data[4];
                        $user->is_admin = 1;
                        $user->save();
                    }
                }
            }
            fclose($handle);
        }
        $this->info("Linked $counter Admins\n");
    }
}
