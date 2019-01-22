@extends('slangs.accept.master')
@section('content')
  <div class="content-section col-12 col-md-9">
      <div class="content">
          <h1 class="col-12 text-center">Zaakceptuj nowe slangi</h1>
          @if ( $slangs->count() > 0 )
              <ul>
              @foreach ( $slangs as $slang )
                  <li><a href="{{ URL::to('/slang/' . $slang -> link) }}">{{ $slang -> slang }}</a></li>
              @endforeach
              </ul>
              <div class="paginate-links">
                {{ $slangs -> links() }}
              </div>
          @else
              <p class="col-12 text-center">Wszystkie najnowsze slangi zostały już zweryfikowane.</p>
          @endif
      </div>
  </div>
@stop
