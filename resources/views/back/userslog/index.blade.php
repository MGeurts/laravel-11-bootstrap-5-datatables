@extends('layouts.back')

@section('title')
    &vert; Users - Log
@endsection

@section('content')
    <div class="card mb-2">
        <div class="card-header d-print-none">
            <div class="row">
                <div class="col">Users - Log (Last 3 months)</div>

                <div class="col fs-5 text-end">
                    <button type="button" class="btn btn-outline-secondary btn-sm me-2" title="Print" tabindex="-1" onclick="window.print();">
                        <img src="{{ asset('img/icons/printer.png') }}" class="img-fluid" />
                    </button>
                    <img src="{{ asset('img/icons/persons.png') }}" class="img-fluid" />
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped table-hover table-sm mb-0 mytable">
            <thead class="table-success">
                <tr>
                    <th class="text-center">Date</th>
                    <th class="text-center">Hour</th>
                    <th class="text-center">User</th>
                    <th class="text-center">IP</th>
                    <th class="text-center">Developer ?</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($userlogs_by_date as $day => $userlogs)
                    <tr class="table-secondary">
                        <td colspan="5">
                            <b>{{ strtoupper(Carbon\Carbon::parse($day)->translatedFormat('l j F Y')) }}</b> ({{ count($userlogs) }})
                        </td>
                    </tr>

                    @foreach ($userlogs as $userlog)
                        <tr>
                            <td></td>
                            <td>{{ $userlog->time }}</td>
                            <td>{{ $userlog->name }}</td>
                            <td class="text-center">{{ $userlog->ip }}</td>
                            @if ($userlog->is_developer)
                                <td class="text-center"><i class="bi bi-check-lg"></i></td>
                            @else
                                <td class="text-center"></td>
                            @endif
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="5" class="p-3">No data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
