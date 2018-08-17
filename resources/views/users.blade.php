@extends('dashboard')

@section('navbar')
  @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
  <div class="position-ref full-height">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Email</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $indexKey => $user)
          <tr>
            <th scope="row">{{ ++$indexKey }}</th>
            <td>{{ $user->email }}</td>
            <td class ="record-manage-column">
              <a type="button" class="btn btn-success btn-record-manage" href="{{ action('UsersController@showEditUser', ['id' => $user->id]) }}">Edit</a>
              <a type="button" class="btn btn-danger btn-record-manage">Remove</a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
