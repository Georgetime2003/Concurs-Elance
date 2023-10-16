@csrf
@extends('layout')
@section('header')
@endsection

@section('pagina')
<div id="toastSuccess" class="toast align-items-center text-bg-success border-0 position-absolute my-3 top-0 start-50 translate-middle-x" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="2000">
    <div class="d-flex">
        <div class="toast-body" id="textCorrecte">
            La pujada de dades s'ha realitzat sense errors
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
<div id="toastError" class="toast align-items-center text-bg-danger border-0 position-absolute my-3 top-0 start-50 translate-middle-x" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="2000">
    <div class="d-flex">
        <div class="toast-body" id="textError">
            Error al pujar error al pujar les dades
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 data-header="h1" class="title my-4">Gestió de Blocs</h2>
            <div class="row">
                <div class="card border-1 shadow rounded-3">
                    <div class="card-body p-2">
                        <div>
                            <ul class="nav nav-tabs" id="navBlocs" role="tablist">
                                <script defer src="{{asset('js/Blocs.js')}}"></script>                                
                            </ul>
                        </div>
                        <br>
                        <div id="contingutModel" hidden>
                            <div class="row">
                                <div class="col-4">
                                    <h3 id="titolBloc" contenteditable="false">Bloc</h3>
                                    <br>
                                    <input type="number" id="idBloc" name="idBloc" hidden>
                                    <label for="categoria" class="form-label">Categoria:</label>
                                    <select class="form-select" id="categoria" name="categoria">
                                        <option value="0">Selecciona una categoria</option>
                                        <option value="1">Amateur</option>
                                        <option value="2">Pre-Professional</option>
                                    </select>
                                    <br>
                                    <label for="Modalitat" class="form-label">Modalitat:</label>
                                    <select class="form-select" id="modalitat" name="modalitat">
                                        <option value="0">Selecciona una modalitat</option>
                                    </select>
                                    <br>
                                    <label for="estils" class="form-label">Estil:</label>
                                    <select class="form-select" id="estils" name="estils">
                                        <option value="0">Selecciona un estil</option>
                                        {{-- @foreach ($estils as $estil)
                                            <option value="{{$estil->id}}">{{$estil->nom}}</option>
                                        @endforeach --}}
                                    </select>
                                    <br>
                                    <label for="subcategoria" class="form-label">Subcategoria:</label>
                                    <select class="form-select" id="subcategoria" name="subcategoria">
                                        <option value="0">Selecciona una subcategoria</option>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-4 offset-1">
                                    <h3>Jutges</h3>
                                    <br>
                                    <label for="jutge1" class="form-label">Jutge 1:</label>
                                    <select class="form-select" id="jutge1" class="jutgeBloc" name="jutge1" disabled="false">
                                        <option value="0">Selecciona un jutge</option>
                                    </select>
                                    <br>
                                    <label for="jutge2" class="form-label">Jutge 2:</label>
                                    <select class="form-select" id="jutge2" class="jutgeBloc" name="jutge2" disabled="true">
                                        <option value="0">Selecciona un jutge</option>
                                    </select>
                                    <br>
                                    <label for="jutge3" class="form-label">Jutge 3:</label>
                                    <select class="form-select" id="jutge3" class="jutgeBloc" name="jutge3" disabled="true">
                                        <option value="0">Selecciona un jutge</option>
                                    </select>
                                </div>
                                <div class="col-1 offset-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="actiu">
                                        <label class="form-check-label" for="actiu">Activar</label>
                                    </div>
                                    <!--Boto esborrar amb fontawesome-->
                                    <button type="button" class="btn btn-danger" id="esborrarBloc" hidden>
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@csrf
@endsection