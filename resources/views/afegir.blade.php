@extends('layout')
@section('header')
<script src="{{asset('js/afegir.js')}}"></script>

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
                <h2 data-header="h1" class="title my-5">Afegir Participants</h2>
                <div class="row">
                    <div class="card border-1 shadow rounded-3">
                        <div class="card-body p-4">
                            <form action="{{route ('afegirParticipants')}}" method="post" enctype="multipart/form-data">
                                <input type="number" name="id" id="idParticipant" hidden>
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h3 data-header="h2">Dades Participant</h3>
                                    </div>
                                    <p/>
                                    <div class="col-4">
                                        <label for="nom" class="form-label">Nom</label>
                                        <input list="noms" class="form-control" id="nom" name="nomParticipant">
                                            <datalist id="noms">
                                                @foreach ($participants as $participant)
                                                    <option value="{{$participant->id}}" data-edat="{{$participant->edat}}">{{$participant->nom}}, {{$participant->cognoms}}</option>
                                                @endforeach
                                            </datalist>
                                    </div>
                                    <div class="col-4">
                                        <label for="cognoms" class="form-label">Cognoms</label>
                                        <input type="text" name="cognoms" id="cognoms" class="form-control" required>
                                    </div>
                                    <div class="col-4">
                                        <label for="edat" class="form-label">Edat Concurs</label>
                                        <input type="number" class="form-control" id="edat" name="edat" min="5" max="50" value="8" required>
                                    </div>
                                    <p/>
                                    <p/>
                                    <div class="col-12">
                                        <h3 data-header="h2">Categoria Participant</h3>
                                    </div>
                                    <p/>
                                    <div class="col-3">
                                        <label for="categoria" class="form-label">Categoria</label>
                                        <select name="categoria" id="categoria" class="form-select" required>
                                            <option value="0">Selecciona una opció</option>
                                            <option value="1">Amateur</option>
                                            <option value="2">Pre-Professional</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="modalitat" class="form-label">Modalitat</label>
                                        <select name="modalitat" id="modalitat" class="form-select" required disabled>
                                            <option value="0" default>Selecciona una categoria</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="estils" class="form-label">Estils</label>
                                        <select name="estils" id="estils" class="form-select" required disabled>
                                            <option value="0" default>Selecciona una Modalitat</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label for="subcategoria" class="form-label">Sub-Categoria</label>
                                        <select name="subcategoria" id="subcategoria" class="form-select" required disabled>
                                            <option value="0" default>Selecciona un Estil</option>
                                        </select>
                                    </div>
                                    </p>
                                    <div class="col-12">
                                        <input name="idGrup" id="idGrup" hidden>
                                        <label for="nomGrup" class="form-label">Nom Grup</label>
                                        <input list="grups" class="form-control" id="nomGrup" name="nomGrup">
                                        <datalist id="grups">
                                            @foreach ($grups as $grup)
                                                <option value="{{$grup->id}}">{{$grup->nomgrup}}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" id="submit" class="btn btn-primary mt-3" disabled>Afegir</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection