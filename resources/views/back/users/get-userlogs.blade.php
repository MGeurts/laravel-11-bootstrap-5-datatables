<div class="card mb-2">
    <div class="card-header text-bg-light">
        <div class="row">
            <div class="col">Log</div>

            <div class="col text-end"><img src="{{ asset('img/icons/history.png') }}" /></div>
        </div>
    </div>

    <table class="table table-bordered table-sm mytable">
        <thead class="table-success">
            <tr>
                <th class="text-center">Date</th>
                <th class="text-center">Hour</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($userlogs_by_date as $day => $userlogs)
                <tr class="table-secondary">
                    <td colspan="2">
                        <b>{{ strtoupper(Carbon\Carbon::parse($day)->translatedFormat('l j F Y')) }}</b> ({{ count($userlogs) }})
                    </td>
                </tr>

                @foreach ($userlogs as $userlog)
                    <tr>
                        <td></td>
                        <td>{{ $userlog->time }}</td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="2" class="p-3">No data found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="card-footer text-bg-light small">Only the 20 most recent items during the last 3 months are shown.</div>
</div>
