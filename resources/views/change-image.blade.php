@extends('layouts.main')

@section('contents')

<div class="container">
<h3>Change your profile picture from here, <span class="text-danger">{{ $user->name }}</span></h3>

<br>
<div>
    <img src="{{ asset($user->image) }}" alt="Image not found" style="max-width: 50%;">
</div>
<br>

<form method="POST" action="{{ route('update.image') }}" enctype="multipart/form-data">
    @csrf

    <div class="form-outline mb-4">
      <input type="file" id="form2Example4" class="form-control" name="image" />
      <label class="form-label" for="form2Example4">Profile Photo</label>
      @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>

    <input type="hidden" name="user_id" value="{{ $user->id }}" />

    <button type="submit" class="btn btn-primary btn-block mb-4">Update Profile Picture</button>

</div>

@endsection