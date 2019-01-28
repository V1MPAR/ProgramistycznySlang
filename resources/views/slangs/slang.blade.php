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
              @if ( App\Slang::checkAccepted($slang -> id) == false && auth()->user()->hasRole('admin') )
                  <li class="list-inline-item text-success"><a href="{{ URL::to('/slang/accept/' . $slang -> id) }}"><i class="fas fa-check vote-up"></i></a></li>
                  <li class="list-inline-item text-danger"><a href="{{ URL::to('/slang/decline/' . $slang -> id) }}"><i class="fas fa-times vote-down"></i></a></li>
              @endif
              @if ( auth()->user() != null )
                @if ( $slang -> user_id == auth()->id() || auth()->user()->hasRole('admin') )
                    <li class="list-inline-item"><a class="black-link" href="{{ URL::to('/slang/' . $slang -> link . '/edit') }}"><i class="fas fa-pen"></i></a></li>
                @endif
              @endif
              @if ( App\Slang::checkAccepted($slang -> id) == true )
                  <li class="list-inline-item" id="vote-count">{{ App\Vote::getVotesCount($slang -> id) }}</li>
                  <li class="list-inline-item text-success"><a href="{{ URL::to('/slang/voteup/' . $slang -> id) }}"><i class="fas fa-chevron-up vote-up"></i></a></li>
                  <li class="list-inline-item text-danger"><a href="{{ URL::to('/slang/votedown/' . $slang -> id) }}"><i class="fas fa-chevron-down vote-down"></i></a></li>
              @endif
          </ul>
      </div>
      <div class="content">
          <h1 class="col-12 text-center">{{ $slang -> slang }}</h1>
          <p class="col-12 text-center">{{ $slang -> description }}</p>
          @if ( $slang -> example !== null )
            <div class="col-10 offset-1 col-md-6 offset-md-3">
                <p class="example">{!! nl2br(htmlentities($slang -> example)) !!}</p>
            </div>
          @endif
          <div class="col-12 slang-info">
              <p>Autor: <b>{{ App\User::getName($slang -> user_id) }}</b></p>
              <p>Dodano: <b>{{ date('d F Y H:i', strtotime($slang -> created_at)) }}</b></p>
              @if ( $slang -> created_at != $slang -> updated_at )
                  <p>Zaktualizowano: <b>{{ date('d F Y H:i', strtotime($slang -> updated_at)) }}</b></p>
              @endif
          </div>
          <div class="col-12 tags">
              @php ( $tags = App\Tag::getTags($slang -> id) )
              @foreach ( $tags as $tag )
                  <a href="{{ URL::to('/tag/' . $tag -> link) }}"><span class="badge badge-red">{{ $tag -> tag }}</span></a>
              @endforeach
          </div>
      </div>
  </div>
@stop
