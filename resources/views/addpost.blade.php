@extends('layouts.main')

@section('contents')
<div class="container">

  <form method="POST" action="{{ route('post.store') }}">
    @csrf

    <div class="form-outline mb-4">
      <input type="text" id="form2Example2" class="form-control" name="title" />
      <label class="form-label" for="form2Example2">Post Title</label>
    </div>

    <div class="form-outline mb-4">
      <input type="text" id="form2Example3" class="form-control" name="post" />
      <label class="form-label" for="form2Example3">Post Content</label>
    </div>

    <input type="hidden" name="user_id" value="{{ $user->id }}" />

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Submit</button>
  </form>

</div>

@endsection