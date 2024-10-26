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
                                        {--live}
                                        {--pause=3 : Number seconds to pause before rechecking status}
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
