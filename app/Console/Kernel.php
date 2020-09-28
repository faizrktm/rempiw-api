<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;
use App\Helper\CekJatuhTempo;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $filePath = base_path().'/cron/CleanSession.txt';
        $schedule->call(new CekJatuhtempo)->daily(env('CRON_DAILY_SCHEDULE', '08:00'))->sendOutputTo($filePath);
    }
}
