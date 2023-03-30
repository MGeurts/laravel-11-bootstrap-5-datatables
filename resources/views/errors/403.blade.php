@extends('errors::layout')

@section('title', __('Forbidden'))
@section('code', '403')

@section('message')
    <h4 class="card-text">You are not authorized to use this page.</h4>
    <hr />
    <ul>
        <li>Click the button
            <button class="btn btn-success btn-sm" type="button" tabindex="-1" disabled>
                <i class="bi bi-house-fill"></i>
            </button>
            to return home,
        </li>
        <br />
        <li>Or click the icon
            <img src="{{ asset('img/general/helpdesk-035.png') }}" class="img-fluid" alt="KREAWEB.be" />
            to contact the helpdesk.
        </li>
    </ul>
@endsection
