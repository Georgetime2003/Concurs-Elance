@csrf
@extends('layout')
@section('header')
@endsection

@section('pagina')
<div id="toastSuccess" class="toast align-items-center text-bg-success border-0 position-absolute my-3 top-0 start-50 translate-middle-x" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="2000">
    <div class="d-flex">
        <div class="toast-body" id="text Correcte">
            La pujada de dades s'ha realitzat sense errors
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
<div id="toastError" class="toast align-items-center text-bg-danger border-0 position-absolute my-3 top-0 start-50 translate-middle-x" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="2000">
    <div class="d-flex">
        <div class="toast-body" id="text Error">
            Error al pujar error al pujar les dades
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 data-header="h1" class="title my-5">Gestió de Blocs</h2>
            <div class="row">
                <div class="card border-1 shadow rounded-3">
                    <div class="card-body p-4">
                        <div>
                            <ul class="nav nav-tabs" id="navBlocs" role="tablist">
                                <script defer src="{{asset('js/Blocs.js')}}"></script>                                
                            </ul>
                        </div>
                        <br>
                        <div id="contingutModel">
                            <div class="row">
                                <div class="col-4">
                                    <h3 id="titolBloc">Bloc</h3>
                                    <br>
                                    <label for="categoria" class="form-label">Categoria</label>
                                    <select class="form-select" id="categoria" name="categoria">
                                        <option value="0">Selecciona una categoria</option>
                                        {{-- @foreach ($categories as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->nom}}</option>
                                        @endforeach --}}
                                    </select>
                                    <br>
                                    <label for="estil" class="form-label">Estil</label>
                                    <select class="form-select" id="estil" name="estil">
                                        <option value="0">Selecciona un estil</option>
                                        {{-- @foreach ($estils as $estil)
                                            <option value="{{$estil->id}}">{{$estil->nom}}</option>
                                        @endforeach --}}
                                    </select>
                                    <br>
                                    <label for="Modalitat" class="form-label">Modalitat</label>
                                    <select class="form-select" id="modalitat" name="modalitat">
                                        <option value="0">Selecciona una modalitat</option>
                                    </select>
                                    <br>
                                    <label for="subcategoria" class="form-label">Subcategoria</label>
                                    <select class="form-select" id="subcategoria" name="subcategoria">
                                        <option value="0">Selecciona una subcategoria</option>
                                    </select>
                                    <br>
                                </div>
                                <div class="col-4 offset-1">
                                    <h3>Jutges</h3>
                                    <br>
                                    <label for="jutge1" class="form-label">Jutge 1</label>
                                    <select class="form-select" id="jutge1" name="jutge1">
                                        <option value="0">Selecciona un jutge</option>
                                    </select>
                                    <br>
                                    <label for="jutge2" class="form-label">Jutge 2</label>
                                    <select class="form-select" id="jutge2" name="jutge2">
                                        <option value="0">Selecciona un jutge</option>
                                    </select>
                                    <br>
                                    <label for="jutge3" class="form-label">Jutge 3</label>
                                    <select class="form-select" id="jutge3" name="jutge3">
                                        <option value="0">Selecciona un jutge</option>
                                    </select>
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