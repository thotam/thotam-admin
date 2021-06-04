<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
        // $schedule->command('inspire')->hourly();

        $schedule->command('thotam-auth:hr-key-sync')->everyFifteenMinutes();
        $schedule->command('thotam-hr:hr-sync')->everyFifteenMinutes();

        $schedule->command('thotam-mkt-congviec:notice-deadline')->dailyAt('08:18');
        $schedule->command('thotam-mkt-mentor:mentor-nhatky-check')->dailyAt('00:07')->withoutOverlapping(15);
        $schedule->command('thotam-mkt-mentor:mentor-nhatky-tonghop')->hourlyAt(23);->withoutOverlapping(15);

        $schedule->command('queue:restart')->hourly();
        $schedule->command('queue:retry all')->everyFifteenMinutes();
        $schedule->command('queue:work --sansdaemon --sleep 3 --tries=5')->everyMinute()->withoutOverlapping(15);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
