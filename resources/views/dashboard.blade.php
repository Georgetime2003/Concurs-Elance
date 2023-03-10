@extends('layout')
@section('pagina')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 data-header="h1" class="title my-5">Concurs de dansa Elancé</h2>
                <div class="row">
                    <div class="card border-1 shadow rounded-3">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-4 -top-3">
                                    <a href="{{route('importacio')}}">
                                    <div class="card card-selector border-0 shadow rounded-3 my-5">
                                        <div class="card-body p-4">
                                            <i class="fa-solid icones fa-upload fa-2xl" ></i>  <span class="offset-1">Importar Participants</span>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-4 -top-3">
                                    <a href="{{-- {{route('importar')}} --}}">
                                    <div class="card card-selector border-0 shadow rounded-3 my-5">
                                        <div class="card-body p-4">
                                            <i class="fa-solid icones fa-table fa-2xl" ></i>  <span class="offset-1">Veure Participants</span>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-4 -top-3">
                                    <a href="{{-- {{route('importar')}} --}}">
                                    <div class="card card-selector border-0 shadow rounded-3 my-5">
                                        <div class="card-body p-4">
                                            {{-- <img src="{{asset('images/dancer.png')}}" class="icona" alt="dancer">  <span class="offset-1">Veure Resultats</span> --}}
                                            <i class="fa-solid icones fa-trophy fa-2xl" ></i>  <span class="offset-1">Veure Resultats</span>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-4 -top-3">
                                    <a href="{{route('afegirParticipants')}}">
                                    <div class="card card-selector border-0 shadow rounded-3 my-5">
                                        <div class="card-body p-4">
                                            <i class="fa-solid icones fa-user-plus fa-2xl" ></i>  <span class="offset-1">Afegir Participants</span>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-4 -top-3">
                                    <a href="{{-- {{route('importar')}} --}}">
                                    <div class="card card-selector border-0 shadow rounded-3 my-5">
                                        <div class="card-body p-4">
                                            <i class="fa-solid icones fa-arrow-down-1-9 fa-2xl" ></i>  <span class="offset-1">Gestionar Blocs</span>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-4 -top-3">
                                    <a href="{{-- {{route('importar')}} --}}">
                                    <div class="card card-selector border-0 shadow rounded-3 my-5">
                                        <div class="card-body p-4">
                                            <i class="fa-solid icones fa-users fa-2xl" ></i>  <span class="offset-1">Crear Jutges</span>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection