@extends('layouts.main')

@section('contents')

<div class="container">
  <h1>Post List</h1>
  <table class="table" id="myTable">
      <thead>
          <tr>
              <th>User ID</th>
              <th>User Name</th>
              <th>Title</th>
              <th>Post</th>
              @if (Auth::user())
                <th>Action</th>
              @endif
          </tr>
      </thead>
      <tbody>
        @foreach($posts as $post)
          <tr>
            <td>{{ $post->poster_id }}</td>
            <td>{{ $post->poster_name }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->post }}</td>
            @if (Auth::user())
              <td>
                <a href="{{ route('post.details', $post->id) }}" class="btn btn-primary">Details</a>
              </td>
            @endif
          </tr>
        @endforeach
      </tbody>
  </table>
</div>

@endsection