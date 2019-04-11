@extends('auth.master')
@section('content')
  <div class="content-section col-12">
      <div class="content">
          <h1 class="col-12 text-center">Logowanie</h1>
          {!! Form::open(['url' => route('login'), 'class' => 'col-10 offset-1 col-lg-6 offset-lg-3']) !!}
              <div class="input-group col-12 mb-3">
                  @if ( count($errors) > 0 )
                    @foreach ( $errors->get('email') as $error )
                      <p class="text-danger col-12">{{ $error }}</p>
                    @endforeach
                  @endif
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  {!! Form::email('email', old('email'), ['class' => 'col-12 form-control', 'placeholder' => 'E-mail']) !!}
              </div>

              <div class="input-group col-12 mb-3">
                  @if ( count($errors) > 0 )
                    @foreach ( $errors->get('password') as $error )
                      <p class="text-danger col-12">{{ $error }}</p>
                    @endforeach
                  @endif
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-star-of-life"></i></span>
                  </div>
                  {!! Form::password('password', ['class' => 'col-12 form-control', 'placeholder' => 'Hasło']) !!}
              </div>

              <div class="input-group col-12" style="padding-left: 40px">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label" for="remember">
                      Zapamiętaj mnie
                  </label>
              </div>

              <div class="input-group col-12 my-auto" style="padding-top: 20px;">
                {{ Form::submit('Zaloguj się', ['class' => 'btn btn-red']) }}
              </div>

              <div class="row h-100" style="padding: 20px;">

                  <div class="col-6 text-left my-auto">
                      <a class="btn btn-link" href="{{ URL::to('/register') }}">
                        Nie masz jeszcze konta?
                      </a>
                  </div>

                  <div class="col-6 text-right my-auto">
                      <a class="btn btn-link" href="{{ route('password.request') }}">
                        Zapomniałeś hasła?
                      </a>
                  </div>

              </div>
          {!! Form::close() !!}
      </div>
  </div>
@stop
