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
  
</div>

@endsection