var blocs = [];
var pasesXBloc = [];
var pases = [];
var paginaActual = 0;

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        url: '/obtenirBlocsActius',
        type: 'POST',
        dataType: 'json',
        data: {
            id: $("#idUsuari").val()
        },
        success: function(data) {
            if (data.length == 0) {
                if (navigator.language == "ca") {
                    alert("No hi ha cap bloc actiu");
                } else if (navigator.language == "es") {
                    alert("No hay ningún bloque activo");
                } else {
                    alert("There is no active block");
                }
                window.location.href = "/";
            }
            blocs = data;
            initBloc();
            console.log(data);
        }
    });
});

function initBloc() {
    for (var i = 0; i < blocs.length; i++) {
        var pasesBloc = blocs[i].pases;
        pasesXBloc.push(pasesBloc);
        for (var j = 0; j < pasesBloc.length; j++) {
            pasesBloc[j].idBloc = i;
            pases.push(pasesBloc[j]);
        }
    }

    mostrarPagina(1);
}


function mostrarPagina(nPag){
    let pase = pases[nPag-1];
    let punt1 = blocs[pase.idBloc].punt1;
    let punt2 = blocs[pase.idBloc].punt2;
    let punt3 = blocs[pase.idBloc].punt3;
    let punt4 = blocs[pase.idBloc].punt4;
    let punt5 = blocs[pase.idBloc].punt5;
    
    $("#categoria").text("Categoria: " + blocs[pase.idBloc].categoria.categoria + "-" + blocs[pase.idBloc].categoria.modalitat + "-" + blocs[pase.idBloc].categoria.estils + "-" + blocs[pase.idBloc].categoria.subcategoria);

}

// Call this function to navigate to the next pase
function siguientePase() {
    if (paginaActual < pases.length - 1) {
        paginaActual++;
        mostrarPase(paginaActual);
    }
}

// Call this function to navigate to the previous pase
function paseAnterior() {
    if (paginaActual > 0) {
        paginaActual--;
        mostrarPase(paginaActual);
    }
}
