@extends('master')
@section('content')
    <div class="col-12 col-md-9 content-section">
        <div class="content">
            @if ( session()->has('success') )
                <p class="text-center text-success">{{ session()->get('success') }}</p>
            @endif
        </div>
    </div>
@stop
