@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-xl-6">
            @include('front.components.home-welcome')
        </div>

        <div class="col-xl-6">
            @include('front.components.home-carousel')
        </div>
    </div>
@endsection
