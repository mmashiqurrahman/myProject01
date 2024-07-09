@extends('layouts.main')

@section('contents')
<div class="container">

  <form method="POST" action="/register">
    @csrf
    <!-- Name input -->
    <div class="form-outline mb-4">
      <input type="text" id="form2Example0" class="form-control" name="name" />
      <label class="form-label" for="form2Example0">Name</label>
    </div>

    <div class="form-outline mb-4">
      <input type="email" id="form2Example1" class="form-control" name="email" />
      <label class="form-label" for="form2Example1">Email address</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
      <input type="password" id="form2Example2" class="form-control" name="password" />
      <label class="form-label" for="form2Example2">Password</label>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>

    <!-- Register buttons -->
    <div class="text-center">
      <p>Already have an account? <a href="{{ route('login.create') }}">Login</a></p>
    </div>
  </form>

</div>

@endsection