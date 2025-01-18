@extends('layouts.back')

@section('title')
    &vert; User Statistics
@endsection

@section('content')
    <div class="row">
        <div class="col-xxl-8 offset-xxl-2">
            <div class="card mb-2">
                <div class="card-header d-print-none">
                    <div class="row">
                        <div class="col">User Statitics - Country of origin</div>

                        <div class="col fs-5 text-end">
                            <button type="button" class="btn btn-outline-secondary btn-sm me-2" title="Print" tabindex="-1" onclick="window.print();">
                                <img src="{{ asset('img/icons/printer.png') }}" class="img-fluid" />
                            </button>
                            <img src="{{ asset('img/icons/statistics.png') }}" class="img-fluid" />
                            <i class="bi bi-person-lines-fill nav-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0" id="svgMap"></div>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/gh/StephanWagner/svgMap@v2.12.0/dist/svgMap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/svg-pan-zoom@3.6.1/dist/svg-pan-zoom.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/StephanWagner/svgMap@v2.12.0/dist/svgMap.min.js"></script>

    <script>
        const map = new svgMap({
            countryNames: @json($countries),
            targetElementID: 'svgMap',
            flagType: 'emoji',
            noDataText: @json('No data'),
            data: {
                data: {
                    visitors: {
                        name: @json('Visitors'),
                        format: '{0}',
                        thousandSeparator: ',',
                    }
                },
                applyData: 'visitors',
                values: @json($data),
            },
        });
    </script>
@endsection
