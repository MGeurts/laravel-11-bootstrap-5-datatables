@extends('layouts.back')

@section('content')
    <div class="accordion" id="accordionImpressum">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Dependencies (*)
                </button>
            </h2>

            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionImpressum">
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-4">
                            <p>Laravel :</p>

                            <ul>
                                <li><a target="_blank" href="https://github.com/yajra/laravel-datatables/">yajra/laravel-datatables</a> -
                                    11.1.5</li>
                            </ul>

                            <ul>
                                <li><a target="_blank" href="https://github.com/spatie/laravel-backup/">spatie/laravel-backup</a> - 9.2.0
                                </li>
                            </ul>

                            <ul>
                                <li><a target="_blank" href="https://github.com/opcodesio/log-viewer/">opcodesio/log-viewer</a> - 3.12.0</li>
                            </ul>

                            <ul>
                                <li><a target="_blank" href="https://github.com/stevebauman/location/">stevebauman/location</a> - 7.4.0
                                </li>
                            </ul>

                            <ul>
                                <li><a target="_blank" href="https://github.com/barryvdh/laravel-debugbar/">barryvdh/laravel-debugbar</a> -
                                    3.14.10</li>
                            </ul>

                            <ul>
                                <li><a target="_blank" href="https://github.com/kevinkhill/lavacharts/">kevinkhill/lavacharts</a> - 3.1.14
                                </li>
                            </ul>
                        </div>

                        <div class="col-4">
                            <p>jQuery :</p>

                            <ul>
                                <li><a target="_blank" href="http://jquery.com/">jQuery</a> - <span class="jQuery_version"></span></li>
                            </ul>

                            <ul>
                                <li><a target="_blank" href="https://getbootstrap.com/">Bootstrap</a> - 5.3.3</li>
                                <li><a target="_blank" href="https://icons.getbootstrap.com//">Bootstrap Icons</a> - 1.11.3
                                </li>
                                <li><a target="_blank" href="https://github.com/coliff/bootstrap-print-css/">Bootstrap Print
                                        CSS</a> - 1.0.1</li>
                            </ul>

                            <ul>
                                <li><a target="_blank" href="https://select2.org/">Select2</a> - 4.1.0-rc0</li>
                                <li><a target="_blank" href="https://github.com/apalfrey/select2-bootstrap-5-theme/">Select2
                                        - Bootstrap 5 Theme</a> - 1.3.0</li>
                            </ul>

                            <ul>
                                <li><a target="_blank" href="https://codeseven.github.io/toastr/">Toastr</a> - 2.1.4</li>
                            </ul>

                            <ul>
                                <li><a target="_blank" href="https://datatables.net/download/packages">DataTables</a> -
                                    2.2.0</li>
                            </ul>
                        </div>

                        <div class="col-4">
                            <p>JavaScript :</p>

                            <ul>
                                <li><a target="_blank" href="http://bootboxjs.com/">Bootbox</a> - 6.0.0</li>
                            </ul>

                            <ul>
                                <li><a target="_blank" href="https://stuk.github.io/jszip/">JSZip</a> - 3.10.1</li>
                            </ul>

                            <ul>
                                <li><a target="_blank" href="https://www.chartjs.org/">chart.js</a> - 4.4.7</li>
                            </ul>

                            <ul>
                                <li><a target="_blank" href="https://github.com/iamkun/dayjs/">dayjs</a> - 1.11.13</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingWebserver">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWebserver" aria-controls="collapseWebserver">
                    Webserver
                </button>
            </h2>

            <div id="collapseWebserver" class="accordion-collapse collapse" aria-labelledby="headingWebserver" data-bs-parent="#accordionImpressum">
                <div class="accordion-body text-center">
                    <img src="{{ asset('img/general/datatables-serverside-processing.png') }}" class="img-fluid" alt="Datatables-SSP" />
                </div>
            </div>
        </div>
    </div>
    <br />

    <p><small>(*) Version numbers can be bumped up.</small></p>
@endsection

@push('scripts')
    <script type="module">
        /* -------------------------------------------------------------------------------------------- */
        $(".jQuery_version").html(jQuery.fn.jquery);
        /* -------------------------------------------------------------------------------------------- */
    </script>
@endpush
