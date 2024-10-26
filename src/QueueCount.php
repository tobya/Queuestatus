<?php

namespace Tobya\Queuestatus;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

class QueueCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:count {--queue= : Queue to query}
                                        {--live}
                                        {--pause=3 : Number seconds to pause before rechecking status}
                                        ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Return number of jobs in Queue';
    protected $hidden = true;

    protected $live_starttime = null;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->live_starttime = now();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (config('queue.default') != 'database'){
            $this->error('Queue Connection must be database to use Queue:Count.');
            return 1;
        }
        if ($this->option ('queue') <> ''){
            $this->info( $this->option('queue').':' . Queue::size($this->option('queue')));
        } else {
            $Qs = DB::select('Select distinct queue from jobs');
            if (count($Qs) > 0){
                $this->info('-----Job Totals-------------------------------------------');
                collect($Qs)->each(function ($queue){
                     $this->info( $queue->queue.':' . Queue::size($queue->queue));
                });
                $this->info('-----Job Info ---------------------------------------');
            } else {
                $this->info('default:0');
            }
        }

        $jobs = Job::take(5)->get();
        //  return $jobs->count() . 'alsdkjflj';
        //$this->info($jobs->count());
        $jobs->each(function ($job){
            $JobDetails = json_decode($job->payload);
            $this->info( $job->queue .' | '. $JobDetails->displayName);
        });

        if ($this->option('live')  ){
            sleep($this->option('pause'));
            // continue for 10 minutes unless stopped.
            if ($this->live_starttime->clone()->addMinutes(10) > now()){
              $this->handle();
            } else {
                $this->info('Queue:Status timeout.');
            }
        }

        return 0;
    }
}
