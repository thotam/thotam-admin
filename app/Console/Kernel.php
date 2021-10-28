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
        $schedule->command('thotam-mkt-mentor:mentor-nhatky-tonghop')->hourlyAt(23)->withoutOverlapping(15);
        $schedule->command('thotam-mkt-mentor:mentor-nhatky-switch')->monthlyOn(3, '05:00')->withoutOverlapping(15);

        $schedule->command('thotam-icpc1hn-api:mkt-dinhnghia-nhomviec-sync')->weeklyOn(1, '04:00')->withoutOverlapping(15);
        $schedule->command('thotam-icpc1hn-api:mkt-dinhnghia-congviec-sync')->weeklyOn(1, '06:00')->withoutOverlapping(15);

        $schedule->command('thotam-icpc1hn-api:icpc1hn-renew-token')->dailyAt('05:30')->withoutOverlapping(15);

        $schedule->command('thotam-mkt-kpi:generate-tdtp')->twiceMonthly(1, 25,'07:23');
        $schedule->command('thotam-mkt-kpi:generate-kpi-canhan')->dailyAt('00:13');
        $schedule->command('thotam-mkt-kpi:generate-kpi-nhom')->dailyAt('05:13');

        $schedule->command('thotam-file-library:clean-public-disk')->daily();

        $schedule->command('thotam-icpc1hn-api:khach-hang-sync')->dailyAt('03:30')->withoutOverlapping(15);
        $schedule->command('thotam-icpc1hn-api:khach-hang-sync')->dailyAt('15:30')->withoutOverlapping(15);

        $schedule->command('thotam-hoithao-etc:nhacnho-mail')->everyTenMinutes();

        $schedule->command('thotam-poster-otc:poster-update-place-id')->dailyAt("01:18");
        $schedule->command('thotam-poster-otc:poster-check-landau')->dailyAt("02:18");

        $schedule->command('queue:restart')->hourly();
        $schedule->command('queue:retry all')->everySixHours();
        $schedule->command('queue:work --sansdaemon --sleep 3 --tries=10')->everyMinute()->withoutOverlapping(15);
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
