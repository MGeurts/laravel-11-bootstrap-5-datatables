@extends('layouts.back')

@section('title')
    &vert; Users Statistics
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card mb-2">
                <div class="card-header d-print-none">
                    <div class="row">
                        <div class="col">Users Statitics - Country of origin</div>

                        <div class="col fs-5 text-end">
                            <button type="button" class="btn btn-outline-secondary btn-sm me-2" title="Print" tabindex="-1" onclick="window.print();">
                                <img src="{{ asset('img/icons/printer.png') }}" class="img-fluid" />
                            </button>
                            <img src="{{ asset('img/icons/statistics.png') }}" class="img-fluid" />
                            <i class="bi bi-person-lines-fill nav-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.umd.js"></script>

    <script type="module">
        /* -------------------------------------------------------------------------------------------- */
        const cData = {!! $chart_data !!};

        const data = {
            labels: cData.label,
            datasets: [{
                data: cData.data,
            }]
        };

        const ctx = document.getElementById("myChart").getContext("2d");
        const myChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Country of origin'
                }
            }
        });
        /* -------------------------------------------------------------------------------------------- */
        window.addEventListener('beforeprint', () => {
            myChart.resize(800, 800);
        });
        window.addEventListener('afterprint', () => {
            myChart.resize();
        });
        /* -------------------------------------------------------------------------------------------- */
    </script>
@endpush
