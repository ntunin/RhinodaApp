@extends('dashboard')

@section('navbar')
  @parent
@endsection

@section('sidebar')
    @parent
@endsection

@section('content')
  <div class="position-ref align-center">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col"></th>
          <th scope="col"><a class="add-button" href="{{action('RolesController@showAddRole')}}"></a></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($roles as $indexKey => $role)
          <tr>
            <th scope="row">{{ ++$indexKey }}</th>
            <td>{{ $role->name }}</td>
            <td>{{ $role->description }}</td>
            <td></td>
            <td class ="record-manage-column">
              <button type="button" class="btn btn-success btn-record-manage">Edit</button>
              <button type="button" class="btn btn-danger btn-record-manage">Remove</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
