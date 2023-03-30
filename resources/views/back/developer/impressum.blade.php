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
                    <p>Laravel :</p>

                    <ul>
                        <li><a target="_blank" href="https://github.com/yajra/laravel-datatables/">yajra/laravel-datatables</a> - 10.3.1</li>
                        <li><a target="_blank" href="https://github.com/ARCANEDEV/LogViewer/">ARCANEDEV/LogViewer</a> - 10.0.0</li>
                    </ul>
                    <br />

                    <p>Bootstrap :</p>

                    <ul>
                        <li><a target="_blank" href="https://getbootstrap.com/">Bootstrap</a> - 5.2.3</li>
                        <li><a target="_blank" href="http://bootboxjs.com/documentation.html">Bootbox</a> - 6.0.0</li>
                    </ul>
                    <br />

                    <p>jQuery :</p>

                    <ul>
                        <li><a target="_blank" href="http://jquery.com/">jQuery</a> - <span class="jQuery_version"></span></li>
                    </ul>

                    <ul>
                        <li><a target="_blank" href="https://select2.org/">Select2</a> - 4.1.0-rc0</li>
                        <li><a target="_blank" href="https://apalfrey.github.io/select2-bootstrap-5-theme/">Select2 - Bootstrap 5 - Theme</a> - 1.3.0</li>
                    </ul>

                    <ul>
                        <li><a target="_blank" href="https://codeseven.github.io/toastr/">Toastr</a> - 2.1.4</li>
                    </ul>

                    <ul>
                        <li><a target="_blank" href="https://datatables.net/download/packages">DataTables</a> - 1.13.4</li>
                    </ul>
                    <br />

                    <p>Javascript :</p>

                    <ul>
                        <li><a target="_blank" href="https://github.com/iamkun/dayjs/">dayjs</a> - 1.11.7</li>
                    </ul>
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
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-6">
                            <table width="100%">
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <a target="_blank" href="https://github.com/leokhoa/laragon/releases">
                                            <img src="{{ asset('img/general/laragon.png') }}" alt="LARAGON" width="200px" />
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="5" class="text-center">6.0.0</td>
                                </tr>
                                <tr>
                                    <td colspan="5"><br /><br /></td>
                                </tr>

                                <tr>
                                    <td class="text-center">
                                        <a target="_blank" href="http://httpd.apache.org/">
                                            <img src="{{ asset('img/general/xampp-apache-001.png') }}" alt="Apache" />
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a target="_blank" href="http://php.net/">
                                            <img src="{{ asset('img/general/xampp-php-001.png') }}" alt="PHP" />
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a target="_blank" href="https://dev.mysql.com/downloads/mysql/">
                                            <img src="{{ asset('img/general/xampp-mysql-001.png') }}" alt="MySQL" />
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <a target="_blank" href="http://www.phpmyadmin.net/">
                                            <img src="{{ asset('img/general/xampp-phpmyadmin-001.png') }}" alt="phpMyAdmin" />
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="5"></td>
                                </tr>

                                <tr>
                                    <td class="text-center">
                                        @if (App::environment('local'))
                                            {{ apache_get_version() }}
                                        @else
                                            ????
                                        @endif
                                    </td>
                                    <td class="text-center">@php echo phpversion(); @endphp</td>
                                    <td class="text-center">8.0.32</td>
                                    <td class="text-center">5.2.1</td>
                                </tr>
                            </table>

                        </div>
                        <div class="col-6 text-center">
                            <img src="{{ asset('img/general/datatables-serverside-processing.png') }}" alt="Datatables-SSP" />
                        </div>
                    </div>
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
