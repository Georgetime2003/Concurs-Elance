@extends('header')
@section('content')
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="{{asset ("logo.png")}}" style="height: auto; width: 5%;">  Concurs Elance</a>
  </div>
</nav>
  @yield('pagina')
@endsection