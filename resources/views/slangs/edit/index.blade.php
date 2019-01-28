@extends('slangs.create.master')
@section('content')
  <div class="content-section col-12 col-md-9">
      <div class="content">
          <h1 class="col-12 text-center">Edytowanie slangu</h1>
          {!! Form::model($slang, ['method' => 'PATCH', 'class' => 'col-10 offset-1 col-md-8 offset-md-2', 'action' => ['SlangsController@update', $slang -> id]]) !!}
              <div class="input-group col-12 mb-3">
                  @if ( count($errors) > 0 )
                    @foreach ( $errors->get('slang') as $error )
                      <p class="text-danger col-12">{{ $error }}</p>
                    @endforeach
                  @endif
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-language"></i></span>
                  </div>
                  {!! Form::text('slang', old('slang'), ['class' => 'col-12 form-control', 'placeholder' => 'Slang']) !!}
              </div>

              <div class="input-group col-12 mb-3">
                  @if ( count($errors) > 0 )
                    @foreach ( $errors->get('description') as $error )
                      <p class="text-danger col-12">{{ $error }}</p>
                    @endforeach
                  @endif
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-pen"></i></span>
                  </div>
                  {!! Form::textarea('description', old('description'), ['class' => 'col-12 form-control', 'placeholder' => 'Opis', 'rows' => '3']) !!}
              </div>

              <div class="input-group col-12 mb-3">
                  @if ( count($errors) > 0 )
                    @foreach ( $errors->get('example') as $error )
                      <p class="text-danger col-12">{{ $error }}</p>
                    @endforeach
                  @endif
                  <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-pen"></i></span>
                  </div>
                  {!! Form::textarea('example', old('example'), ['class' => 'col-12 form-control', 'placeholder' => 'Przykład', 'rows' => '3']) !!}
              </div>

              <div class="bootstrap-tagsinput col-12 mb-3">
                  @if ( count($errors) > 0 )
                    @foreach ( $errors->get('tags') as $error )
                      <p class="text-danger col-12">{{ $error }}</p>
                    @endforeach
                  @endif
	                <input type="text" data-role="tagsinput" name="tags" value="">
              </div>

              <div class="input-group col-12" style="margin: 25px 0;">
                  {{ Form::submit('Edytuj slang', ['class' => 'btn btn-red', 'id' => 'addSlang']) }}
              </div>
          {!! Form::close() !!}
      </div>
  </div>
@stop
