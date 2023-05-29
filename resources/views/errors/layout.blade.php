@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mb-2">
                <div class="card-header">
                    <div class="row">
                        <div class="col">Error</div>
                        <div class=" col fs-5 text-end">
                            <i class="bi bi-bug-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <img src="{{ asset('img/administration.jpg') }}" class="d-block w-100" alt="administration" />
                        </div>

                        <div class="col-md-6">
                            <div class="card-body">
                                <h2 class="card-title">@yield('code')</h2>
                                <h3 class="card-title">@yield('title')</h3>
                                <hr />

                                @yield('message')
                                <hr />

                                <div class="row d-flex align-items-end">
                                    <div class="col">
                                        <a class="btn btn-lg btn-success text-white me-1" href="/" title="Start" role="button" tabindex="-1">
                                            <i class="bi bi-house-fill"></i>
                                        </a>
                                    </div>

                                    <div class="col fs-5 text-end">
                                        <a href="mailto:info@yourcompany.be" target="_blank" title="Mail Helpdesk">
                                            <img src="{{ asset('img/general/helpdesk-035.png') }}" class="img-fluid" alt="mailhelpdesk" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-sm small d-none d-md-block">
                            <img src="{{ asset('img/logo/laravel-030.png') }}" alt="company" />
                        </div>

                        <div class="col-sm small d-none d-md-block text-end">
                            &copy; {{ now()->year }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
