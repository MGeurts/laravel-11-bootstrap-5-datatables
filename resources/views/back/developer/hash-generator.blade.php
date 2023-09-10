@extends('layouts.back')


@section('title')
    &vert; Hash Generator
@endsection

@section('content')
    <form id="FormHashGenerator" class="form-horizontal" role="form" method="post" action="{{ route('back.developer.hashGenerator') }}">
        @csrf
        @method('GET')

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mb-2">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">Hash Generator</div>

                            <div class="col fs-5 text-end">
                                <i class="bi bi-key-fill"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-2">
                            <label for="value" class="col-3 col-form-label">Value :</label>

                            <div class="col-9">
                                <input id="value" name="value" type="text" class="form-control" value="{{ $value }}" autofocus>
                            </div>
                        </div>
                        <hr />

                        <div class="row mb-2">
                            <label for="value" class="col-3 col-form-label">Hash :</label>

                            <div class="col">
                                <h5>{{ $hash }}</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row">
                            <div class="col"></div>

                            <div class="col text-end">
                                <button type="submit" class="btn btn-primary text-white btn-sm" tabindex="-1">Generate</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
