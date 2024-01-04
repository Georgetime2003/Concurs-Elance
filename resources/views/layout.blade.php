@extends('header')
@section('content')
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid align-items-center">
    <a class="navbar-brand" href="inici"><img src="{{asset ("logo.png")}}" style="height: auto; width: 5%;" alt="Logo Concurs Élancé">  Concurs Élancé</a>
    <!--Boto de menú amb menú lateral-->
    <div class="justify-content-end">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasDarkNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    </div>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menú</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="inici"><i class="fa-solid fa-home"></i> Inici</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="importacio"><i class="fa-solid fa-upload"></i> Importar Participants</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="participants"><i class="fa-solid fa-user-plus"></i> Afegir Participants</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="veureparticipants"><i class="fa-solid fa-table"></i> Veure Participants</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="blocs"><i class="fa-solid fa-arrow-down-1-9"></i> Gestionar Blocs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dashboard"><i class="fa-solid fa-trophy"></i> Veure Resultats</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="dashboard"><i class="fa-solid fa-users"></i> Crear Jutges</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>
  @yield('pagina')
@endsection