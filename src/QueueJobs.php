<?php

namespace Tobya\Queuestatus;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

class QueueJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:jobs {--count=10} {--queue=} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Details of Jobs in Queue';

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
     * @return int
     */
    public function handle()
    {
        if (config('queue.default') != 'database'){
            $this->error('Queue Connection must be database to use Queue:jobs');
            return 1;
        }


        $jobs = Job::take($this->option('count'))->get();
        //  return $jobs->count() . 'alsdkjflj';
        //$this->info($jobs->count());
        $jobs->each(function ($job){
            $JobDetails = json_decode($job->payload);
            $this->info( $job->queue .' | '. $JobDetails->displayName);
        });

    }
}
