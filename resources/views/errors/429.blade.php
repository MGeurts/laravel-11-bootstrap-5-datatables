@extends('errors::layout')

@section('title', __('Too Many Requests'))
@section('code', '429')

@section('message')
    <h4 class="card-text">The server is handling too many requests.</h4>
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
