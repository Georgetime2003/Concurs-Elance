@extends('header')
@section('content')
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="inici"><img class="d-inline-block align-text-top" src="{{asset ("logo.png")}}" height="50" width="50" alt="Logo Concurs Élancé"><a href="logout" class="btn btn-outline-danger"><i class="fa-solid fa-sign-out"></i></a></a>
  </div>
</nav>
  @yield('pagina')
@endsection