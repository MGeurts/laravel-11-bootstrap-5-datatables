<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

class BackupController extends Controller
{
    // ------------------------------------------------------------------------------
    // To make this BACKUP controller work, you need to :
    // ------------------------------------------------------------------------------
    //      1. install laravel-backup
    //         https://github.com/spatie/laravel-backup
    //
    //      2. add and configure this to your .env :
    //
    //          BACKUP_DISK="backups"
    //          BACKUP_DAILY_CLEANUP="22:30"
    //          BACKUP_DAILY_RUN="23:00"
    //          BACKUP_MAIL_ADDRESS="webmaster@yourdomain.com"
    //
    //      3. configure this to a working mail system in your .env :
    //          MAIL_MAILER=smtp
    //          MAIL_HOST=mailpit
    //          MAIL_PORT=1025
    //          MAIL_USERNAME=null
    //          MAIL_PASSWORD=null
    //          MAIL_ENCRYPTION=null
    //          MAIL_FROM_ADDRESS="no-reply@yourdomain.com"
    //          MAIL_FROM_NAME="${APP_NAME}"
    // ------------------------------------------------------------------------------
    //      4. add this to your config/filesystem.php :
    //
    //          env('BACKUP_DISK', 'backups') => [
    //              'driver' => 'local',
    //              'root' => storage_path('app/' . env('BACKUP_DISK', 'backups')),
    //              'throw' => false,
    //          ],
    // ------------------------------------------------------------------------------
    //      5. configure this in your config/backup.php :
    //
    //          // backup --> destination --> disks :
    //          'disks' => [
    //              env('BACKUP_DISK', 'backups'),
    //          ]
    //
    //          // backup --> monitor-backups --> disks :
    //          'disks' => [
    //              env('BACKUP_DISK', 'backups'),
    //          ]
    // ------------------------------------------------------------------------------
    public function index()
    {
        $disk = Storage::disk(config('app.backup_disk'));
        $files = $disk->files(config('backup.backup.name'));

        $backups = [];

        // make an array of backup files, with their filesize and creation date
        foreach ($files as $k => $f) {
            // only take the zip files into account
            if (substr($f, -4) == '.zip' && $disk->exists($f)) {
                $backups[] = [
                    'file_path' => $f,
                    'file_name' => str_replace(config('backup.backup.name') . '/', '', $f),
                    'file_size_byte' => $disk->size($f),
                    'file_size' => Number::fileSize($disk->size($f), 2),
                    'last_modified_timestamp' => $disk->lastModified($f),
                    'date_created' => Carbon::createFromTimestamp($disk->lastModified($f))->format('d-m-Y H:i'),
                    'date_ago' => Carbon::createFromTimestamp($disk->lastModified($f))->diffForHumans(Carbon::now()),
                ];
            }
        }

        // reverse the backups, so the newest one would be on top
        $backups = array_reverse($backups);

        return view('back.backups.index')->with(compact('backups'));
    }

    public function create()
    {
        $exitCode = Artisan::call('backup:run --only-db');
        $output = Artisan::output();

        if ($exitCode == 0) {
            Log::info("Backup (Manually) -- Backup started \r\n" . $output);

            $notification = [
                'type' => 'info',
                'title' => 'Backups ...',
                'message' => 'The backup was created.',
            ];
        } else {
            Log::error("Backup (Manually) -- Backup failed \r\n" . $output);

            $notification = [
                'type' => 'error',
                'title' => 'Backups ...',
                'message' => 'The backup failed.',
            ];
        }

        return redirect()->back()->with('notification', $notification);
    }

    public function download($file_name)
    {
        $disk = Storage::disk(config('app.backup_disk'));
        $file = config('backup.backup.name') . '/' . $file_name;

        if ($disk->exists($file)) {
            return Storage::download(config('app.backup_disk') . '/' . $file);
        } else {
            $notification = [
                'type' => 'warning',
                'title' => 'Backups ...',
                'message' => 'The backup file was not found.',
            ];

            return redirect()->back()->with('notification', $notification);
        }
    }

    public function delete($file_name)
    {
        $disk = Storage::disk(config('app.backup_disk'));
        $file = config('backup.backup.name') . '/' . $file_name;

        if ($disk->exists($file)) {
            $disk->delete($file);

            $notification = [
                'type' => 'info',
                'title' => 'Backups ...',
                'message' => 'The backup file is deleted.',
            ];
        } else {
            $notification = [
                'type' => 'warning',
                'title' => 'Backups ...',
                'message' => 'The backup file was not found.',
            ];
        }

        return redirect()->back()->with('notification', $notification);
    }
}
