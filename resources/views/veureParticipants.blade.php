@extends('layout')
@section('header')
<script src="{{asset('js/veureParticipants.js')}}"></script>
@endsection
@section('pagina')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 data-header="h1" class="title my-4">Veure participants</h2>
            <div class="row">
                <div class="card border-1 shadow rounded-3">
                    <div class="card-body p-2">
                        <div class="row">
                            <div class="col-12 top-3">
                                <table id="taula" class="table table-fixed">
                                    <thead class="bg-success text-light">
                                        <tr>
                                            <th id="nomParticipant">Nom</th>
                                            <th id="cognoms">Cognoms</th>
                                            <th id="edat">Edat Concurs</th>
                                            <th id="categoria">Categoria</th>
                                            <th id="estil">Estil</th>
                                            <th id="modalitat">Modalitat</th>
                                            <th id="subCategoria">Sub-Categoria</th>
                                            <th id="nomBall">Grup / Ball</th>
                                            <th id="nPase">Nº Grup</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @foreach ($participacions as $participant)
                                            <tr>
                                                <td>{{$participant->participants->nom}}</td>
                                                <td>{{$participant->participants->cognoms}}</td>
                                                <td>{{$participant->participants->edat}}</td>
                                                <td>{{$participant->categories->categoria}}</td>
                                                <td>{{$participant->categories->estils}}</td>
                                                <td>{{$participant->categories->modalitat}}</td>
                                                <td>{{$participant->categories->subcategoria}}</td>
                                                <td>{{$participant->grups->nomgrup}}</td>
                                                <td>{{$participant->grups->id}}</td>
                                            </tr>
                                        @endforeach
                                        

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection