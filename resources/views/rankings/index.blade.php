@extends('rankings.master')
@section('content')
  <div class="content-section col-12 col-lg-9">
      <div class="content">
          <h1 class="text-center">Ranking</h1>
          <div class="row">
              <div class="col-12 col-lg-4">
                  <div class="content">
                      <i class="fas fa-pen icon"></i>
                      <h3>najwięcej napisanych slangów</h3>
                      <ul class="users">
                          @php ( $i = 0 )
                          @foreach ( $rankingSlangs as $slangs )
                              @if ( $i == 0 )
                                  <li><i class="fas fa-trophy first"></i><b>{{ App\User::getName($slangs->user_id) }}</b> ({{ $slangs->count }})</li>
                              @elseif ( $i == 1 )
                                  <li><i class="fas fa-trophy second"></i><b>{{ App\User::getName($slangs->user_id) }}</b> ({{ $slangs->count }})</li>
                              @elseif ( $i == 2 )
                                  <li><i class="fas fa-trophy second"></i><b>{{ App\User::getName($slangs->user_id) }}</b> ({{ $slangs->count }})</li>
                              @else
                                  <li>{{ App\User::getName($slangs->user_id) }} ({{ $slangs->count }})</li>
                              @endif
                          @php ( $i++ )
                          @endforeach
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
@stop
