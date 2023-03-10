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
        $('#nom').on('change', function(){
            if ($.isNumeric($(this).val())) {
                $('#idParticipant').val($(this).val());
                let nom = $('#noms option[value="' + $(this).val() + '"]').text();
                let cognoms = nom.split(' ');
                let id = $(this).val();
                $('#nom').val(cognoms[0]);
                $('#cognoms').val('')
                for (let i = 1; i < cognoms.length; i++) {
                    $('#cognoms').val($('#cognoms').val() + cognoms[i] + ' ');
                }
                let opcions = $('#noms option');
                let edat;
                for (let i = 0; i < opcions.length; i++) {
                    if (opcions[i].value == id) {
                        edat = $(opcions[i]).attr('data-edat');
                    }
                }
                $('#edat').val(edat);
            }
        })
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
                <h2 data-header="h1" class="title my-5">Afegir Participants</h2>
                <div class="row">
                    <div class="card border-1 shadow rounded-3">
                        <div class="card-body p-4">
                            <form action="{{route ('importacio')}}" method="post" enctype="multipart/form-data">
                                <input type="number" name="id" id="idParticipant" hidden>
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h3 data-header="h2">Dades Participant</h3>
                                    </div>
                                    <p/>
                                    <p/>
                                    <div class="col-4">
                                        <label for="nom" class="form-label">Nom</label>
                                        <input list="noms" class="form-control" id="nom">
                                            <datalist id="noms">
                                                @foreach ($participants as $participant)
                                                    <option value="{{$participant->id}}" data-edat="{{$participant->edat}}">{{$participant->nom}} {{$participant->cognoms}}</option>
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
                                    <p/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection