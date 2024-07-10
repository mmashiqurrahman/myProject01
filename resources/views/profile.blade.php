@extends('layouts.main')

@section('contents')

<div class="container">
  <h3>This is your Profile page, {{ $user->name }}</h3>
  <h3>Your email: {{ $user->email }}</h3>
</div>

@endsection