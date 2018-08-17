@extends('dashboard')

@section('title', 'Page Title')

@section('sidebar')
    @parent
@endsection

@section('content')
  <div class="flex-center position-ref full-height">
      <img class="logo" src = "{{URL::asset('/images/logo.png')}}">
  </div>
@endsection
