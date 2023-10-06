<?php

namespace App\Console\Commands;

use App\Console\Commands\TestJob;
use Illuminate\Console\Command;

class DispatchTestJobCommand extends Command
{
     /**
      * The name and signature of the console command.
      *
      * @var string
      */
     protected $signature = 'dispatch:test-job';
     /**
      * The console command description.
      *
      * @var string
      */


     protected $description = 'Dispatch a test job';
     public function handle()
     {
          dispatch(new TestJob());
          $this->info('Test job dispatched');
     }
     /**
      * Execute the console command.
      */
}
