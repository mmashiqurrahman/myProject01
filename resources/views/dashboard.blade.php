@extends('layouts.main')

@section('contents')

<div class="container">
  <p>This is your Dashboard, <span class="text-danger">{{ $user->name }}</span></p>
  <p>Your email: {{ $user->email }}</p>
  <hr><br>

  <h4>History</h4>
  <table class="table">
      <thead>
          <tr>
              <th>ID</th>
              <th>Question</th>
              <th>Answer</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($aiReplies as $aiReply)
              <tr>
                  <td>{{ $aiReply->id }}</td>
                  <td>{{ $aiReply->question }}</td>
                  <td>{{ $aiReply->answer }}</td>
              </tr>
          @endforeach
      </tbody>
  </table>
  <hr><br>
  
  <div class="row">
    <div class="col-6">
      <form method="POST" action="/send-to-ai">
      @csrf

      <div class="form-outline mb-4">
        <label class="form-label" for="question">Ask anything</label>
        <input type="text" id="question" class="form-control" name="question" />
      </div>

      <button type="submit" class="btn btn-primary btn-block mb-4">Send</button>

      </form>
    </div>
  </div>
</div>

@endsection