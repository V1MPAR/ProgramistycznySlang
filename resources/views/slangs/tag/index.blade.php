@extends('slangs.tag.master')
@section('content')
  <div class="content-section col-12 col-md-9">
      <div class="content">
          <h1 class="col-12 text-center">{{ $tag }}</h1>
          @if ( ! isset($exist) )
              <ul>
              @foreach ( $slangs as $slang )
                  <li><a href="{{ URL::to('/slang/' . $slang -> link) }}">{{ $slang -> slang }}</a></li>
              @endforeach
              </ul>
              <div class="paginate-links">
                {{ $slangs -> links() }}
              </div>
          @else
              <p class="col-12 text-center">Niestety, ale nie istnieje jeszcze żaden slang dla tagu "{{ $tag }}" :/</p>
              <div class="col-12 text-center">
                  <a href="{{ URL::to('/slang/create') }}">Może to Twój zaistnieje jako pierwszy?</a>
              </div>
          @endif
      </div>
  </div>
@stop
