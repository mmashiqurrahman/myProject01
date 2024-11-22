@extends('layouts.main')

@section('contents')
<div class="container col-6">
  <h3>Add a Comment</h3>
  <br>

  <form method="POST" action="{{ route('comment.store') }}">
    @csrf

    <div class="form-outline mb-4">
      <input type="text" id="form2Example2" class="form-control" name="comment" />
      <label class="form-label" for="form2Example2">Your Comment</label>
    </div>

    <input type="hidden" name="post_id" value="{{ $post_id }}" />
    <input type="hidden" name="commenter_id" value="{{ $commenter_id }}" />

    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Submit</button>
  </form>

</div>

@endsection