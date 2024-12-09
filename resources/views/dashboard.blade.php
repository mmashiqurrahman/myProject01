@extends('layouts.main')

@section('contents')

<div class="container">
  <div>
    <img src="{{ asset($user->image) }}" alt="Image not found" style="max-width: 50%;">
  </div>
  <br>
  <a class="btn btn-secondary" href="{{ route('change.image') }}">Change Profile Picture</a> 
  <a class="btn btn-secondary" href="{{ route('download.image') }}">Download Profile Picture</a>
  <br>
  
  <h3>This is your Dashboard, <span class="text-danger">{{ $user->name }}</span></h3>
  <h3 class="bg-warning">Your email: {{ $user->email }}</h3>
  <h4>Dashboard contains all of your News Feeds.</h4>
</div>

@endsection