<?php

namespace Dev\Larabit\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class LarabitCommand extends Command
{
    protected $signature = 'larabit-command';

    protected $description = 'Larabit Command';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info("Command executed with config param value " . Config::get('larabit.param'));

        return 0;
    }
}
