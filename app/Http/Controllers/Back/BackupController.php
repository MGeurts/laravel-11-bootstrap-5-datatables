<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BackupController extends Controller
{
    public function index()
    {
        $disk = Storage::disk('local');

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
                    'file_size' => $this->humanFilesize($disk->size($f)),
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
        try {
            Artisan::call('backup:run --only-db');
            $output = Artisan::output();

            Log::info("Backup (Manually) -- Backup started \r\n" . $output);

            $notification = [
                'type' => 'info',
                'title' => 'Backups ...',
                'message' => 'The backup was created.',
            ];
        } catch (Exception $e) {
            Log::info("Backup (Manually) -- Backup failed \r\n" . $e->getMessage());

            $notification = [
                'type' => 'error',
                'title' => 'Backups ...',
                'message' => $e->getMessage(),
            ];
        }

        return redirect()->back()->with('notification', $notification);
    }

    public function download($file_name)
    {
        $disk = Storage::disk('local');
        $file = config('backup.backup.name') . '/' . $file_name;

        if ($disk->exists($file)) {
            return Storage::download($file);
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
        $disk = Storage::disk('local');
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

    protected function humanFilesize($bytes, $decimals = 2)
    {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }
}
