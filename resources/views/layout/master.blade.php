<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <title>@yield('title')</title>
    <style>
        a{
            color:rgb(202, 195, 195) !important;
        }
        .active, .logout{
            color: rgb(255, 255, 255) !important;
        }
        .right{
            right: 20px;
            position: absolute;
        }
    </style>
    @yield('css')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand" href="{{ route('home') }}">QuantumIT</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link {{ route('home') == request()->url() ? 'active' : '' }}" href="{{ route('home') }}">Home </a>
        <a class="nav-item nav-link {{ route('companies.index') == request()->url() ? 'active' : '' }}" href="companies">Companies</a>
        <a class="nav-item nav-link {{ route('employees.index') == request()->url() ? 'active' : '' }}" href="employees">Employees</a>
        <a class="nav-item nav-link right logout" href="{{route('logout')}}">Logout</a>
      </div>
    </div>
  </nav>

  <section>
      @yield('container')
  </section>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  @yield('js')
</body>
</html>
