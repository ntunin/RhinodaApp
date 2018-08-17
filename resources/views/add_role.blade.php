@extends('dashboard')

@section('navbar')
  @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
  <div class="position-ref align-center">
    <div class="auth-form">
      {{ Form::open(array('url' => 'roles/add')) }}
      <h1>Role</h1>

      <p>
      {{ $errors->first('name') }}
      {{ $errors->first('description') }}
      {{ $errors->first('auth') }}
      </p>

      <p class="input-row">
      {{ Form::label('name', 'Name') }}
      {{ Form::text('name', Input::old('text'), array('placeholder' => 'user')) }}
      </p>

      <p class="input-row">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description') }}
      </p>

      <p>{{ Form::submit('Add') }}</p>
    </div>
  </div>
@endsection
