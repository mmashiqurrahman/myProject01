<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">CompanyLogo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('role.list') }}">Roles</a>
            </li>

            @if (Auth::guest())
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register.create') }}">Register</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login.create') }}">Login</a>
              </li>
            @endif
            
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user.list') }}">User List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('post.list') }}">Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('role.create') }}">Add Roles</a>
            </li>

            @if (Auth::check())
              <li class="nav-item">
                <a class="nav-link" href="{{ route('post.create') }}">Add Posts</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('user.profile') }}">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('friends') }}">Friends</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">Log out</a>
              </li>
            @endif
            
          </ul>
        </div>
      </nav>
      
      <br>