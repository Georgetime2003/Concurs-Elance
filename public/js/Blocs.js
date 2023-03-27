var toastElList = document.querySelectorAll('.toast');
var toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));
var toastError = toastList[1];
var toastSuccess = toastList[0];

var blocs;
window.onload = function () {
    blocs = new Blocs();
    Promise.resolve(obtenirBlocs()).then(function () {
        blocs.init();
    });
};

class Blocs {

    constructor() {
        this.blocs = [];
    }

    init() {
        let navBlocs = $('#navBlocs');
        navBlocs.empty();
        this.blocs.forEach(bloc => {
            navBlocs.append('<li class="nav-item"><a id="'+ bloc.id + '" class="nav-link" href="#bloc' + bloc.id + '" data-bs-toggle="tab"> Bloc ' + bloc.id + '</a></li>');
            //Quan es fa click a un bloc, activa un event que canvia el bloc actiu
            $('#' + bloc.id).click(function (event) {
                blocs.blocs.forEach(bloc => {
                    bloc.classList.remove('bloc--active');
                });
                $('#bloc' + bloc.id).addClass('bloc--active');
                mostrarBloc(event);
            });
        });
        //Boto afegir bloc alinetat a la dreta
        navBlocs.append('<li id="blocAfegir" class="nav-item ms-auto"><a class="nav-link" href="#blocAfegir" data-bs-toggle="tab"><i class="fas fa-plus"></i></a></li>');
        $('#blocAfegir').click(function () {
            crearBloc();
        });
        this.blocs = document.querySelectorAll('.bloc');
        this.blocs.forEach(bloc => {
            bloc.addEventListener('click', this.blocClick);
        });
    }

    blocClick() {
        this.classList.toggle('bloc--active');
    }

    setBlocs(params) {
        this.blocs = params;
    }

}

function obtenirBlocs() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    return $.ajax({
        url: '/obtenirBlocs',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            blocs.setBlocs(data);
        },
        error: function (data) {
            //Add wait time for toast while it is shown
            toastError.show();
        }
    });
}

function crearBloc() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/crearBloc',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            blocs.setBlocs(data);
            blocs.init();
            toastSuccess.show();
        },
        error: function (data) {
            //Add wait time for toast while it is shown
            toastError.show();
        }
    });
}

function mostrarBloc(event) {
    event.preventDefault();
    let bloc = event.target;
    $("#titolBloc").text(bloc.text);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/mostrarBloc',
        type: 'POST',
        dataType: 'json',
        data: {
            id: bloc.id
        },
        success: function (data) {
            mostrarDadesBloc(data);
        }
    });
}

function mostrarDadesBloc(data) {

}