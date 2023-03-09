@extends('layout')
@section('header')
<script>
    window.onload = function() {
        $('#fitxerCSV').on('change', function() {
            if ($(this).val() == '') {
                $('button').prop('disabled', true);
            } else {
                if ($(this).val().split('.').pop().toLowerCase() != 'csv') {
                    alert('El fitxer no és un .csv');
                    $('button').prop('disabled', true);
                    $(this).val('');
                } else{
                    $('button').prop('disabled', false);
                }
            }
        });
        $('.toast').toast({delay: 50000});
        $('.toast').toast('show');
    }
</script>

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
                <h2 data-header="h1" class="title my-5">Importació de Participants</h2>
                <div class="alert alert-warning" role="alert">
                    Assegureu-vos de fer la Importació quan es tanquin les inscripcions via web WOP
                </div>
                <div class="row">
                    <div class="card border-1 shadow rounded-3">
                        <div class="card-body p-4">
                            <h4>Per obtenir el fitxer .csv aneu al següent enllaç: <a class="enllaç" target="_blank" href="https://www.wop.online/organizers/Q9H9mBsiXBksCkkLH">WOP</a></h4>
                            <hr>
                            <form action="{{route ('importacio')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <label for="afegirFitxer" class="form-label"> Afegir Fitxer .csv </label>
                                    </div>
                                    <div class="col-6">
                                        <input class="form-control" id="fitxerCSV" name="file" type="file" accept=".csv">
                                    </div>
                                    <p/>
                                    <p/>
                                    <p/>
                                    <div class="col-6 offset-5">
                                           <button type="submit" class="btn btn-primary" disabled>Importar</button>
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