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
    protected $signature = 'queue:count {--queue= : Queue to query}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Return number of jobs in Queue';
    protected $hidden = true;
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
            $this->error('Queue Connection must be database to use Queue:Count.');
            return 1;
        }

        if ($this->option ('queue') <> ''){
            $this->info( $this->option('queue').':' . Queue::size($this->option('queue')));
        } else {
            $Qs = DB::select('Select distinct queue from jobs');
            if (count($Qs) > 0){
                collect($Qs)->each(function ($queue){
                     $this->info( $queue->queue.':' . Queue::size($queue->queue));
                });
            } else {
                $this->info('default:0');
            }
        }
        return 0;
    }
}
