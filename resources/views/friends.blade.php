@extends('layouts.main')

@section('contents')

<div class="container">
  @foreach($users as $user)
    <div>
      {{ $user->id }}. {{ $user->name }} 
      <a class="btn btn-secondary" href="{{ route('chat', ['fromuser' => Auth::user()->id, 'touser' => $user->id]) }}">Chat</a>
      <hr>
    </div>
  @endforeach
</div>

@endsection