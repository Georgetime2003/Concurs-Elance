var toastElList = document.querySelectorAll('.toast');
var toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));
var toastError = toastList[1];
var toastSuccess = toastList[0];

var blocs;
var jutges;
window.onload = function () {
    blocs = new Blocs();
    $('#categoria').attr('disabled', true);
    $('#estils').attr('disabled', true);
    $('#modalitat').attr('disabled', true);
    $('#subcategoria').attr('disabled', true);
    $('#jutge1').attr('disabled', true);
    $('#jutge2').attr('disabled', true);
    $('#jutge3').attr('disabled', true);
    $("#actiu").attr('disabled', true);
    document.getElementById('textCorrecte').innerHTML = 'Sel·lecciona un bloc per poder modificar';
    toastSuccess.show();
    Promise.resolve(obtenirBlocs()).then(function () {
        blocs.init();
    });
    $("#categoria").on("change", function () {
    if ($(this).val() != "0") {
            netejarModalitat();
            $("#modalitat").prop("disabled", false);
            //Afegim les modalitats
            let modalitat1 = document.createElement("option");
            modalitat1.value = "1";
            modalitat1.text = "Solo";
            if ($(this).val() == "1") {
                let modalitat2 = document.createElement("option");
                modalitat2.value = "2";
                modalitat2.text = "Duos/Trios";
                let modalitat3 = document.createElement("option");
                modalitat3.value = "3";
                modalitat3.text = "Grupal";
                $("#modalitat").append(modalitat1, modalitat2, modalitat3);
            } else if ($(this).val() == "2") {
                let modalitat2 = document.createElement("option");
                modalitat2.value = "2";
                modalitat2.text = "Duet";
                $("#modalitat").append(modalitat1, modalitat2);
            }
            netejarEstils();
            netejarSubCategories();
            $("#estils").prop("disabled", true);
            $("#subcategoria").prop("disabled", true);
            $("#submit").prop("disabled", true);
            
        } else {
            netejarModalitat();
            $("#modalitat").val("0").change();
            $("#estils").prop("disabled", true);
            netejarEstils();
            $("#estils").val("0").change();
            $("#subcategoria").prop("disabled", true);
            netejarSubCategories();
            $("#subcategoria").val("0").change();
            $("#submit").prop("disabled", true);
            
        }
    });

    $("#modalitat").on("change", function () {
        if ($(this).val() != 0) {
            netejarEstils();
            if ($("#categoria").val() == 1) {
                let estils = ["", "Clàssic", "Contemporani", "Fusió", "Jazz"];
                for (let i = 1; i <= 4; ++i) {
                    let estil = document.createElement("option");
                    estil.value = i;
                    estil.text = estils[i];
                    $("#estils").append(estil);
                }
                $("#estils").prop("disabled", false);
            } else {
                let estils = ["", "Clàssic", "Contemporani", "Dues Variacions"];
                for (let i = 1; i <= 3; ++i) {
                    let estil = document.createElement("option");
                    estil.value = i;
                    estil.text = estils[i];
                    $("#estils").append(estil);
                }
                $("#estils").prop("disabled", false);
            }
            netejarSubCategories();
            $("#subcategoria").prop("disabled", true);
            $("#submit").prop("disabled", true);
        } else {
            netejarEstils();
            $("#estils").val("0").change();
            $("#estils").prop("disabled", true);
            netejarSubCategories();
            $("#subcategoria").prop("disabled", true);
            $("#submit").prop("disabled", true);
            
        }
    });

    $("#estils").on("change", function () {
        if ($(this).val() != 0) {
            netejarSubCategories();
            if ($("#categoria").val() == 1) {
                for (let i = 0; i <= 5; ++i){
                    let subcategoria = document.createElement("option");
                    subcategoria.value = i + 1;
                    subcategoria.text = "C" + i;
                    $("#subcategoria").append(subcategoria);
                }
                $("#subcategoria").prop("disabled", false);
                $("#submit").prop("disabled", true);
                
            } else {
                if ($("#modalitat").val() == 2) {
                        let subcategoria = document.createElement("option");
                        subcategoria.value = 1;
                        subcategoria.text = "C" + 0;
                        $("#subcategoria").append(subcategoria);
                        $("#subcategoria").val(1).change();
                        ;
                } else {
                    for (let i = 0; i <= 2; ++i){
                        let subcategoria = document.createElement("option");
                        subcategoria.value = i + 1;
                        subcategoria.text = "C" + i;
                        $("#subcategoria").append(subcategoria);
                    }
                    $("#subcategoria").prop("disabled", false);
                    $("#subcategoria").prop("readonly", false);
                    $("#submit").prop("disabled", true);
                    
                }
            }
        } else {
            netejarSubCategories();
            $("#subcategoria").val("0").change();
            $("#submit").prop("disabled", true);
            
        }
    });
    $("#subcategoria").on("change", function () {
    });

    $('#esborrarBloc').click(function () {
        if (confirm("Estàs segur que vols esborrar el bloc?")) {
            esborrarBloc();
        }
    } );

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
        mostrarDadesBloc(this)
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

function obtenirJutges() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    return $.ajax({
        url: '/jutgesBlocs',
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            jutges = data;
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
    $("#contingutModel").attr("hidden", false);
    console.log(data);
    $("#idBloc").val(data.id);
    setTimeout(function () {
        if (data.categoria_id == null){
            $('#categoria').attr('disabled', false);
            $('#categoria').val(0).change();
            $('#modalitat').val(0).change();
            $('#subcategoria').val(0).change();
            $('#estils').val(0).change();
            $('#modalitat').attr('disabled', true);
            $('#subcategoria').attr('disabled', true);
            $('#estils').attr('disabled', true);
        } else {
            $('#categoria').attr('disabled', true);
            if (data.categoria.categoria == "Amateur"){
                $('#categoria').val(1).change();
                $('#categoria').attr('disabled', false);
                let subcategoria = comprovarModalitat(data.categoria.modalitat);
                comprovarEstils(data.categoria.estils);
                comprovaSubcategoria(data.categoria.subcategoria);
            } else {
                $('#categoria').val(2).change();
                $('#categoria').attr('disabled', false);
                let subcategoria = comprovarModalitat(data.categoria.modalitat);
                comprovarEstils(data.categoria.estils);
                if (!subcategoria){
                    comprovaSubcategoria(data.categoria.subcategoria);
                }
            }
        }
        if (data.jutges[0].jutge_id != null){
            $('#jutge1').val(data.jutges[0].jutge_id).change();
            $('#jutge1').attr('disabled', false);
        } else {
            $('#jutge1').val(0).change();
            $('#jutge1').attr('disabled', false);
        }
        if (data.jutges[1].jutge_id != null){
            $('#jutge2').val(data.jutges[1].jutge_id).change();
            $('#jutge2').attr('disabled', false);
        } else {
            $('#jutge2').val(0).change();
            $('#jutge2').attr('disabled', true);
        }
        if (data.jutges[2].jutge_id != null){
            $('#jutge3').val(data.jutges[2].jutge_id).change();
            $('#jutge3').attr('disabled', false);
        } else {
            $('#jutge3').val(0).change();
            $('#jutge3').attr('disabled', true);
        }
        if (data.actiu == 1){
            $('#actiu').click(activarBloc);
            $('#actiu').prop('checked', true);
        } else {
            $('#actiu').click(activarBloc);
            $('#actiu').prop('checked', false);
        }
    }, 1);
    $('#titolBloc').attr('contenteditable', true);
    $('#jutge1').val(0).change();
    $('#jutge2').val(0).change();
    $('#jutge3').val(0).change();
    $('#actiu').prop('disabled', false);
    $('#jutge1').prop('disabled', false);
    $('#jutge2').prop('disabled', true);
    $('#jutge3').prop('disabled', true);
    $('#esborrarBloc').prop('hidden', false);
}

function netejarModalitat() {
    $("#modalitat").prop("disabled", true);
    let length = $("#modalitat option").length;
    for (let i = 1; i <= length; i++) {
        $('#modalitat option[value="' + i + '"]').remove();
    }
}

function netejarEstils() {
    $("#estils").prop("disabled", true);
    let length = $("#estils option").length;
    for (let i = 1; i <= length; i++) {
        $('#estils option[value="' + i + '"]').remove();
    }
}

function netejarSubCategories() {
    $("#subcategoria").prop("disabled", true);
    $("#subcategoria").prop("readonly", false);
    let length = $("#subcategoria option").length;
    for (let i = 1; i <= length; i++) {
        $('#subcategoria option[value="' + i + '"]').remove();
    }
}

function esborrarBloc() {
    let id = $("#idBloc").val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/esborrarBloc',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id
        },
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

function comprovarEstils(estils) {
    if (estils == "Clàssic") {
        $('#estils').val(1).change();
    } else if (estils == "Contemporani") {
        $('#estils').val(2).change();
    } else if (estils == "Fusió" || estils == "Dues Variacions"){
        $('#estils').val(3).change();
    } else if (estils == "Jazz"){
        $('#estils').val(4).change();
    }
}

function comprovarModalitat(modalitat){
    if (modalitat == "Solo"){
        $('#modalitat').val(1).change();
    } else if (modalitat == "Duos/Trios" || modalitat == "Duet"){
        $('#modalitat').val(2).change();
        if (modalitat == "Duet"){
            return true;
        }
    } else if (modalitat == "Grupal"){
        $('#modalitat').val(3).change();
    }
    return false;
}

function comprovaSubcategoria(subcategoria){
    if (subcategoria == "C0"){
        $('#subcategoria').val(1).change();
    } else if (subcategoria == "C1"){
        $('#subcategoria').val(2).change();
    } else if (subcategoria == "C2"){
        $('#subcategoria').val(3).change();
    } else if (subcategoria == "C3"){
        $('#subcategoria').val(4).change();
    } else if (subcategoria == "C4"){
        $('#subcategoria').val(5).change();
    } else if (subcategoria == "C5"){
        $('#subcategoria').val(6).change();
    }
}

function activarBloc(){
    if ($('#actiu').prop('checked') == false){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/desactivarBloc',
            type: 'POST',
            dataType: 'json',
            data: {
                id: $('#idBloc').val()
            },
            success: function (data) {
                document.getElementById('textCorrecte').innerHTML = data.data;
                toastSuccess.show();
            }
        });
    } else {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/activarBloc',
            type: 'POST',
            dataType: 'json',
            data: {
                id: $('#idBloc').val()
            },
            success: function (data) {
                document.getElementById('textCorrecte').innerHTML = data.data;
                toastSuccess.show();
            }
        });
    }
}
function assignarJutge(pos, id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '/assignarJutge',
        type: 'POST',
        dataType: 'json',
        data: {
            id: $('#idBloc').val(),
            pos: pos,
            jutge: id
        },
        success: function (data) {
            document.getElementById('textCorrecte').innerHTML = data.data;
            toastSuccess.show();
        }
    });
}