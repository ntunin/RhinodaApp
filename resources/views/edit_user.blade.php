@extends('dashboard')

@section('navbar')
  @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
  <div class="position-ref align-center">
    <div class="submit-form">
      {{ Form::open(array('url' => 'users/'.$user->id.'/edit')) }}
      <h1>User</h1>

      <p class="input-row">
      {{ Form::label('email', 'Email') }}
        <div class="user-email">{{$user->email}}</div>
      </p>

      <p class="input-row">
        {{ Form::label('roles', 'Roles') }}
        @foreach ($roles as $role)
          <div class = "user-role">
            {{ Form::checkbox('roles[]', $role->id, $user->hasRole($role) ) }}
            {{ Form::label($role->name, ucwords ($role->name)) }}<br>
          </div>
        @endforeach
      </p>

      <p>{{ Form::submit('Edit') }}</p>
    </div>
  </div>
@endsection
