<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.1.4/datatables.min.css" rel="stylesheet">

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">CompanyLogo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('homepage')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register.create') }}">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login.create') }}">Login</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('user.list') }}">User List</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>

            @if (Auth::check())
              <li class="nav-item">
                <a class="nav-link" href="{{ route('user.profile') }}">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">Log out</a>
              </li>
            @endif

          </ul>
        </div>
      </nav>

      <br>



<div class="container">
  <h1>User List</h1>
  <table class="table" id="myTable">
      <thead>
          <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Role</th>
              <th>Email</th>
          </tr>
      </thead>
  </table>
</div>





<script src="https://code.jquery.com/jquery-3.7.0.slim.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.1.4/datatables.min.js"></script>

<script>
$(document).ready( function () {
    $('#myTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('get.users') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'role', name: 'role' },
            { data: 'email', name: 'email' }
        ]
    });
} );
</script>

</body>
</html>
