@extends('layouts.main')

@section('contents')

<div class="container">
  <h1>Role List</h1>
  <table class="table" id="myTable">
      <thead>
          <tr>
              <th>ID</th>
              <th>Name</th>
          </tr>
      </thead>
      <tbody>
        @foreach($roles as $role)
          <tr>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div>

@endsection