<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // cleanup obsolete backups
        $schedule->command('backup:clean')->daily()->at(env('BACKUP_DAILY_CLEANUP', '22:30:00'))
            ->onSuccess(function () {
                Log::info('Backup (Scheduled) -- Cleanup succeeded');
            })
            ->onFailure(function () {
                Log::warning('Backup (Scheduled) -- Cleanup failed');
            });

        // create daily backup
        $schedule->command('backup:run --only-db')->daily()->at(env('BACKUP_DAILY_RUN', '23:00:00'))
            ->onSuccess(function () {
                Log::info('Backup (Scheduled) -- Backup succeeded');
            })
            ->onFailure(function () {
                Log::warning('Backup (Scheduled) -- Backup failed');
            });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
