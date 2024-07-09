@extends('layouts.main')

@section('contents')
<div class="container">

  <h1>Guest Page 01</h1>

  <form method="POST" action="/user-page-01">
    @csrf
    <!-- Email input -->
    <div class="form-outline mb-4">
      <input type="text" name="token" />
      <label class="form-label" for="form2Example1">Token</label>
    </div>

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Submit</button>
  </form>

</div>

@endsection