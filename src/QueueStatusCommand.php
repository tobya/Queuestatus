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
    protected $signature = 'queue:status {--queue= : Queue to query}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Queue Count Status';
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

}
