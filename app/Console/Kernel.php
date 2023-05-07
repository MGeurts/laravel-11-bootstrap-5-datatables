<?php

namespace App\Console;

use App\Mail\BackupExecuted;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // cleanup obsolete backups
        $schedule->command('backup:clean')->daily()->at(env('BACKUP_DAILY_TIME', '23:00:00'));

        // create daily backup
        $schedule->command('backup:run')->daily()->at(env('BACKUP_DAILY_TIME', '23:00:00'))
            ->onFailure(function () {
                // Send mail to Admin
                $content['message'] = 'Backup (Scheduled) -- Backup failed';
                $content['body'] = 'TThe scheduled backup was executed and failed with errors.';

                Mail::to(env('MAIL_FROM_ADDRESS', 'hello@example.com'))->send(new BackupExecuted($content));

                // Log action
                Log::warning('Backup (Scheduled) -- Backup failed');
            })
            ->onSuccess(function () {
                // Send mail to Admin
                $content['message'] = 'Backup (Scheduled) -- Backup succeeded';
                $content['body'] = 'The scheduled backup was executed and succeeded.';

                Mail::to(env('MAIL_FROM_ADDRESS', 'hello@example.com'))->send(new BackupExecuted($content));

                // Log action
                Log::info('Backup (Scheduled) -- Backup succeeded');
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
