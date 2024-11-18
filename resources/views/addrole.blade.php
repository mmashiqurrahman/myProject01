@extends('layouts.main')

@section('contents')
<div class="container">
    <h3>Add a Role</h3>
    <br>

  <form method="POST" action="{{ route('role.store') }}">
    @csrf
    <!-- Name input -->
    <div class="form-outline mb-4">
      <input type="text" id="form2Example0" class="form-control" name="name" />
      <label class="form-label" for="form2Example0">Role Name</label>
    </div>
    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Add Role</button>
  </form>

</div>

@endsection