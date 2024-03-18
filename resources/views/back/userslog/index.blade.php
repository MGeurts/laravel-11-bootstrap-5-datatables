@extends('layouts.back')

@section('title')
    &vert; Users - Log
@endsection

@section('content')
    <div class="card mb-2">
        <div class="card-header d-print-none">
            <div class="row">
                <div class="col">Users - Log (Last {{ $months }} months)</div>

                <div class="col fs-5 text-end">
                    <button type="button" class="btn btn-outline-secondary btn-sm me-2" title="Print" tabindex="-1" onclick="window.print();">
                        <img src="{{ asset('img/icons/printer.png') }}" class="img-fluid" />
                    </button>
                    <i class="bi bi-person-lines-fill nav-icon"></i>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped table-hover table-sm mb-0 myTable">
            <thead class="table-primary">
                <tr>
                    <th class="text-center">Date</th>
                    <th class="text-center">Hour</th>
                    <th class="text-center">User</th>
                    <th class="text-center">Country Name</th>
                    <th class="text-center">Country Code</th>
                    <th class="text-center">Developer ?</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($userlogs_by_date as $day => $userlogs)
                    <tr class="table-secondary">
                        <td colspan="6">
                            <b>{{ $day }}</b> ({{ count($userlogs) }})
                        </td>
                    </tr>

                    @foreach ($userlogs as $userlog)
                        <tr>
                            <td></td>
                            <td>{{ $userlog->time }}</td>
                            <td>{{ $userlog->name }}</td>
                            <td>{{ $userlog->country_name }}</td>
                            <td>{{ $userlog->country_code }}</td>
                            @if ($userlog->is_developer)
                                <td class="text-center"><i class="bi bi-check-lg"></i></td>
                            @else
                                <td class="text-center"></td>
                            @endif
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="6" class="p-3">No data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
