@extends('auth.masterRegister')
@section('content')
  <div class="content-section col-12">
      <div class="content">
          <h1 class="col-12 text-center">Rejestracja</h1>
          {!! Form::open(['url' => route('register'), 'class' => 'col-10 offset-1 col-lg-6 offset-lg-3']) !!}
              <div class="input-group col-12 mb-3">
                  @if ( count($errors) > 0 )
                    @foreach ( $errors->get('name') as $error )
                      <p class="text-danger col-12">{{ $error }}</p>
                    @endforeach
                  @endif
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  {!! Form::text('name', old('name'), ['class' => 'col-12 form-control', 'placeholder' => 'Nazwa użytkownika']) !!}
              </div>

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

              <div class="input-group col-12 mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-star-of-life"></i></span>
                </div>
                {!! Form::password('password_confirmation', ['class' => 'col-12 form-control', 'placeholder' => 'Powtórz hasło']) !!}
              </div>

              <div class="row h-100" style="padding: 20px;">

                  <div class="input-group col-6 my-auto">
                    {{ Form::submit('Zarejestruj się', ['class' => 'btn btn-red']) }}
                  </div>

                  <div class="col-6 text-right my-auto">
                      <a class="btn btn-link" href="{{ URL::to('/login') }}">
                        Masz już konto?
                      </a>
                  </div>

              </div>
          {!! Form::close() !!}
      </div>
  </div>
@stop
