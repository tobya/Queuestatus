<?php

namespace Tobya\Queuestatus;

use Illuminate\Console\Command;


class QueueStatusCommand extends QueueCount
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:status {--queue= : Queue to query}
                                        {--live : Keep Checking Queue every few seconds }
                                        {--pause=3 : Number seconds to pause before rechecking status}
                                        {--count=5 : Number of jobs to show}
                                        ';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue Count Status';
    protected $hidden = false;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

}
