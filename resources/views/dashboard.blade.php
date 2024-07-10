@extends('layouts.main')

@section('contents')

<div class="container">
  <h3>This is your Dashboard, <span class="text-danger">{{ $user->name }}</span></h3>
  <h3 class="bg-warning">Your email: {{ $user->email }}</h3>
</div>

@endsection