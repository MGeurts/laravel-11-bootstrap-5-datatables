@extends('layouts.back')

@section('title')
    &vert; Backups
@endsection

@section('content')
    <div class="row">
        <div class="col-xxl-8 offset-xxl-2">
            <div class="card mb-2">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            Backups
                            @if (count($backups))
                                ({{ count($backups) }})
                            @endif
                        </div>

                        <div class="col text-center">
                            <a href="{{ route('back.backups.create') }}" class="btn btn-sm btn-success" title="Nieuwe backup aanmaken">
                                <i class="bi bi-plus-circle-fill"></i> New backup
                            </a>
                        </div>

                        <div class="col fs-5 text-end">
                            <i class="bi bi-archive-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <table id="sqltable" class="table table-bordered table-striped table-sm myTable">
                        <thead class="table-primary">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">File</th>
                                <th class="text-center">Size</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Age</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($backups))
                                @foreach ($backups as $key => $backup)
                                    <tr>
                                        <td class="text-end">{{ ++$key }}.</td>
                                        <td>{{ $backup['file_name'] }}</td>
                                        <td class="text-end">{{ $backup['file_size'] }}</td>
                                        <td class="text-center">{{ $backup['date_created'] }}</td>
                                        <td>{{ $backup['date_ago'] }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('back.backups.download', $backup['file_name']) }}" class="btn btn-sm btn-primary" title="Download backup">
                                                <i class="bi bi-download"></i> Download
                                            </a>

                                            &nbsp;&nbsp;

                                            <a href="{{ route('back.backups.delete', $backup['file_name']) }}" class="btn btn-sm btn-danger" title="Verwijder backup">
                                                <i class="bi bi-trash-fill"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="p-3">No data found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    Backups can be automated (run daily) by issuing the following cron job on your production server :
                    <code>
                        <pre>* * * * * cd /path_to_your_application && php artisan schedule:run >> /dev/null 2>&1</pre>
                    </code>
                    An e-mail will be send to your applications e-mail address after each backup.
                </div>
            </div>
        </div>
    </div>
@endsection
