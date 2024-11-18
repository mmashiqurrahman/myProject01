@extends('layouts.main')

@section('contents')

<div class="container">
  <h1>Post List</h1>
  <table class="table" id="myTable">
      <thead>
          <tr>
              <th>User</th>
              <th>Title</th>
              <th>Post</th>
          </tr>
      </thead>
      <tbody>
        @foreach($posts as $post)
          <tr>
            <td>{{ $post->user_id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->post }}</td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div>

@endsection