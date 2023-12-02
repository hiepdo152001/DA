<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\LeaveDaysUpdate::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule):void
    {
        // $schedule->command('inspire')->hourly();
        // php artisan leave-days:update
        // php artisan schedule:work
        $schedule->command('worktime:send')->monthlyOn(02, '11:02');
        $schedule->command('leave-days:update')->monthlyOn(02, '11:03');
    }
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
