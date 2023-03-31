@extends('layout')
@section('header')
<script src="{{asset('js/afegir.js')}}"></script>

@endsection

@section('pagina')
<!--Error de pàgina 404-->
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 data-header="h1" class="title my-5">Error 404</h2>
            <div class="row">
                <div class="card border-1 shadow rounded-3">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-12">
                                <h3 data-header="h2">La pàgina que intentes cercar no existeix</h3>
                            </div>
                            <p/>
                            <div class="col-12">
                                <a href="/inici" class="btn btn-primary">Torna a l'inici</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection