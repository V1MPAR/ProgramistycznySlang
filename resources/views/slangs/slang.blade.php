@extends('slangs.master')
@section('content')
  <div class="content-section col-12 col-md-9">
      <div class="options-content">
          <ul class="col-12 list-inline text-right">
              @if ( session()->has('error') )
                  <li class="list-inline-item text-danger">{{ session()->get('error') }}</li>
              @elseif ( session()->has('success') )
                  <li class="list-inline-item text-success">{{ session()->get('success') }}</li>
              @endif
              <li class="list-inline-item" id="vote-count">{{ App\Vote::getVotesCount($slang -> id) }}</li>
              <li class="list-inline-item text-success"><a href="{{ URL::to('/slang/voteup/' . $slang -> id) }}"><i class="fas fa-chevron-up vote-up"></i></a></li>
              <li class="list-inline-item text-danger"><a href="{{ URL::to('/slang/votedown/' . $slang -> id) }}"><i class="fas fa-chevron-down vote-down"></i></a></li>
          </ul>
      </div>
      <div class="content">
          <h1 class="col-12 text-center">{{ $slang -> slang }}</h1>
          <p class="col-12 text-center">{{ $slang -> description }}</p>
          @if ( $slang -> example !== null )
            <div class="col-12 text-center">
                <span class="example">{!! $slang -> example !!}</span>
            </div>
          @endif
      </div>
  </div>
@stop
