@csrf
@extends('layout2')
@section('header')
<script src="{{asset('js/votacions.js')}}"></script>

@endsection

@section('pagina')
<input type="number" id="idUsuari" value="{{Auth::user()->id}}" hidden>
<div id="toastSuccess" class="toast align-items-center text-bg-success border-0 position-absolute my-3 top-0 start-50 translate-middle-x" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="2000">
    <div class="d-flex">
        <div class="toast-body" id="text Correcte">
            S'han enviat els resultats Correctament
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
<div id="toastError" class="toast align-items-center text-bg-danger border-0 position-absolute my-3 top-0 start-50 translate-middle-x" role="alert" aria-live="assertive" aria-atomic="true" data-autohide="true" data-delay="2000">
    <div class="d-flex">
        <div class="toast-body" id="text Error">
            No s'han pogut enviar els resultats, torna a intentar-ho o contacta amb un membre del concurs.
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-11 offset-1">
            <h6 id="nPase">Pase Nº: </h6>
        </div>
        <div class="col-lg-3 col-11 offset-1">
            <h6 id="categoria">Categoria: </h6>
        </div>
        <div class="col-lg-3 col-11 offset-1">
            <h6 id="edat">Edat: </h6>
        </div>
    </div>
    <div class="mb-3"></div>
    <div class="row">
        <div class="card border-1 shadow rounded-3">
            <div class="card-body p-4">
                <form>
                <div class="row">
                    <div class="col-lg-3 col-11 offset-1">
                        <p id="item1"></p>
                    </div>
                    <div class="col-lg-3 col-11 offset-1">
                        <!-- Track color gradient -->
                        <input type="range" class="form-range colorRang" id="item1Val" min="0" max="10" step="0.5" value="0">
                    </div>
                    <div class="col-lg-3 col-11 offset-1">
                        <p id="item1ValText">0</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-11 offset-1">
                        <p id="item2"></p>
                    </div>
                    <div class="col-lg-3 col-11 offset-1">
                        <!-- Track color gradient -->
                        <input type="range" class="form-range colorRang" id="item2Val" min="0" max="10" step="0.5" value="0">
                    </div>
                    <div class="col-lg-3 col-11 offset-1">
                        <p id="item2ValText">0</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-11 offset-1">
                        <p id="item3"></p>
                    </div>
                    <div class="col-lg-3 col-11 offset-1">
                        <!-- Track color gradient -->
                        <input type="range" class="form-range colorRang" id="item3Val" min="0" max="10" step="0.5" value="0">
                    </div>
                    <div class="col-lg-3 col-11 offset-1">
                        <p id="item3ValText">0</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-11 offset-1">
                        <p id="item4"></p>
                    </div>
                    <div class="col-lg-3 col-11 offset-1">
                        <!-- Track color gradient -->
                        <input type="range" class="form-range colorRang" id="item4Val" min="0" max="10" step="0.5" value="0">
                    </div>
                    <div class="col-lg-3 col-11 offset-1">
                        <p id="item4ValText">0</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-11 offset-1">
                        <p id="item5"></p>
                    </div>
                    <div class="col-lg-3 col-11 offset-1">
                        <!-- Track color gradient -->
                        <input type="range" class="form-range colorRang" id="item5Val" min="0" max="10" step="0.5" value="0">
                    </div>
                    <div class="col-lg-3 col-11 offset-1">
                        <p id="item5ValText">0</p>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="mb-3"></div>
        <div class="row justify-content-between">
            <div class="col-8">
                <br>
                <p>Puntuació Total: <span id="puntuacioTotal">0</span></p>
            </div>
            <div class="col-2 offset-2" >
                <button type="button" class="btn btn-primary" id="enviarVotacio">Enviar Votació</button>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <button id="btnAnterior" type="button" class="btn btn-primary">Anterior</button>
    </div>
</div>
@endsection