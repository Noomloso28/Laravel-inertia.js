<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use App\Models\Notifications;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        /** run check new submit occurrences every 5 minutes */
        $schedule->command('queue:work --queue=occurrences')->everyFiveMinutes()->withoutOverlapping();

        /** remove notifications had read ready status every 15 days */
        $schedule->call(function (){
            Notifications::whereNotNull('read_at')->delete();
        })->cron('0 0 */15 * *')->name('Remove notifications read ready');
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
