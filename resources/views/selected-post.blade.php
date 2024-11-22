@extends('layouts.main')

@section('contents')

<div class="container">
  <h3> <span class="text-muted">Post from:</span> {{ $post->poster_name }}</h3>
  <hr>
  <h1>{{ $post->title }}</h1>
  <br>
  <p class="border border-primary p-3">
    {{ $post->post }}  
  </p>

  <a href="{{ route('comment.create', $post->id) }}">Add a Comment</a>
  
  <br><hr><br>

    <div>
      @foreach($comments as $single_comment)

        <strong>{{ $single_comment->commenter }}</strong>: {{ $single_comment->comment }} <hr>

      @endforeach
    </div>

</div>

@endsection