@extends('layout')
@section('header')
<script src="{{asset('js/simple-slider.min.js')}}"></script>
<script type="module" src="{{asset('js/crearJutges.js')}}"></script>

@endsection

@section('pagina')
@isset($success)
    <div class="toast align-items-center text-bg-success border-0 position-absolute my-3 top-0 start-50 translate-middle-x" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                La pujada de dades s'ha realitzat sense errors
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
@endisset
@isset($error)
    <div class="toast align-items-center text-bg-danger border-0 position-absolute my-3 top-0 start-50 translate-middle-x" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Error al pujar error {{$error}}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
@endisset
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 data-header="h1" class="title my-5">Crear Jutges</h2>
                <div class="row">
                    <div class="card border-1 shadow rounded-3">
                        <div class="card-body p-4">
                           <form action="{{route ('crearJutges')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label for="nJutges" class="form-label">Nombre de Jutges</label>
                                </div>
                                <div class="col-6">
                                    <input type="number" name="nJutges" id="nJutges" class="form-control" min="1" max="10" value="1" required>
                                </div>
                                <div class="col-6 offset-6">
                                    <input type="range" name="nJutgesR" id="nJutgesR" class="form-range" min="1" max="10" value="1" required>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Crear Jutges</button>
                                </div>
                            </div>
                            @isset($jutges)
                                <table id="jutges" class="table table-striped table-hover table-bordered mt-5">
                                    <thead class="table-dark">
                                        <tr class="text-center">
                                            <th class="align-middle">Usuari</th>
                                            <th class="align-middle">Contrasenya</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-light">
                                        @foreach ($jutges as $jutge)
                                            <tr>
                                                <td id="u{{$jutge->id}}" contenteditable onchange="canviarNomUsuari()">{{$jutge->usuari}}</td>
                                                <td id="p{{$jutge->id}}" contenteditable onchange="canvarContrasenya()">{{$jutge->contrasenya}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection