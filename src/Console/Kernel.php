<?php

namespace Dev\Larabit\Console;

use Illuminate\Console\Scheduling\Schedule;

/**
 * @created on 30/04/2023 by yuriyuriev
 * larabit
 */
class Kernel extends \App\Console\Kernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('telescope:prune --hours=48')->daily();
    }
}
