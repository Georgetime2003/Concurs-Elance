var blocs = [];
var pasesXBloc = [];
var pases = [];
var paginaActual = 0;
var edat = 0;
var nParticipants = 0;
var lang = navigator.language;

$(document).ready(function() {
    $("#item1Val").on("input",function() {
        $("#item1ValText").text($("#item1Val").val());
        $("#puntuacioFinalText").text(((parseFloat($("#item1Val").val()) + parseFloat($("#item2Val").val()) + parseFloat($("#item3Val").val()) + parseFloat($("#item4Val").val()) + parseFloat($("#item5Val").val()))/5).toFixed(2));
    });
    $("#item2Val").on("input",function() {
        $("#item2ValText").text($("#item2Val").val());
        $("#puntuacioFinalText").text(((parseFloat($("#item1Val").val()) + parseFloat($("#item2Val").val()) + parseFloat($("#item3Val").val()) + parseFloat($("#item4Val").val()) + parseFloat($("#item5Val").val()))/5).toFixed(2));
    });
    $("#item3Val").on("input",function() {
        $("#item3ValText").text($("#item3Val").val());
        $("#puntuacioFinalText").text(((parseFloat($("#item1Val").val()) + parseFloat($("#item2Val").val()) + parseFloat($("#item3Val").val()) + parseFloat($("#item4Val").val()) + parseFloat($("#item5Val").val()))/5).toFixed(2));
    });
    $("#item4Val").on("input",function() {
        $("#item4ValText").text($("#item4Val").val());
        $("#puntuacioFinalText").text(((parseFloat($("#item1Val").val()) + parseFloat($("#item2Val").val()) + parseFloat($("#item3Val").val()) + parseFloat($("#item4Val").val()) + parseFloat($("#item5Val").val()))/5).toFixed(2));
    });
    $("#item5Val").on("input",function() {
        $("#item5ValText").text($("#item5Val").val());
        $("#puntuacioFinalText").text(((parseFloat($("#item1Val").val()) + parseFloat($("#item2Val").val()) + parseFloat($("#item3Val").val()) + parseFloat($("#item4Val").val()) + parseFloat($("#item5Val").val()))/5).toFixed(2));
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#btnSeguent").click(function() {
        pasarPase(true);
    });
    $("#btnAnterior").click(function() {
        pasarPase(false);
    });
    $("#enviarVotacio").click(enviarVotacio);
    
    $.ajax({
        url: '/obtenirBlocsActius',
        type: 'POST',
        dataType: 'json',
        data: {
            id: $("#idUsuari").val()
        },
        success: function(data) {
            if (lang == "ca") {
                lang = "ca-ES";
            } else if (lang == "es") {
                lang = "es-ES";
            }
            if (data.length == 0) {
                if (navigator.language == "ca-ES" || navigator.language == "ca") {
                    alert("No hi ha cap bloc actiu");
                } else if (navigator.language == "es-ES" || navigator.language == "es") {
                    alert("No hay ningún bloque activo");
                } else {
                    alert("There is no active block");
                }
                window.location.href = "/";
            }
            blocs = Array.from(data);
            initBloc();
            console.log(data);
        }
    });
});

function initBloc() {
    for (var i = 0; i < blocs.length; i++) {
        var pasesBloc = blocs[i].grups;
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
    pase.canvis = false;
    let punt1 = blocs[pase.idBloc].sistema_puntuacio1;
    let punt2 = blocs[pase.idBloc].sistema_puntuacio2;
    let punt3 = blocs[pase.idBloc].sistema_puntuacio3;
    let punt4 = blocs[pase.idBloc].sistema_puntuacio4;
    let punt5 = blocs[pase.idBloc].sistema_puntuacio5;
    switch (blocs[pase.idBloc].nJutge) {
        case 1:
            $("#item1Val").val(pase.puntuacio1_1 == null ? 0 : pase.puntuacio1_1).change();
            $("#item1ValText").text(pase.puntuacio1_1 == null ? 0 : pase.puntuacio1_1);
            $("#item2Val").val(pase.puntuacio2_1 == null ? 0 : pase.puntuacio2_1).change();
            $("#item2ValText").text(pase.puntuacio2_1 == null ? 0 : pase.puntuacio2_1);
            $("#item3Val").val(pase.puntuacio3_1 == null ? 0 : pase.puntuacio3_1).change();
            $("#item3ValText").text(pase.puntuacio3_1 == null ? 0 : pase.puntuacio3_1);
            $("#item4Val").val(pase.puntuacio4_1 == null ? 0 : pase.puntuacio4_1).change();
            $("#item4ValText").text(pase.puntuacio4_1 == null ? 0 : pase.puntuacio4_1);
            $("#item5Val").val(pase.puntuacio5_1 == null ? 0 : pase.puntuacio5_1).change();
            $("#item5ValText").text(pase.puntuacio5_1 == null ? 0 : pase.puntuacio5_1);
            break;
        case 2:
            $("#item1Val").val(pase.puntuacio1_2 == null ? 0 : pase.puntuacio1_2).change();
            $("#item1ValText").text(pase.puntuacio1_2 == null ? 0 : pase.puntuacio1_2);
            $("#item2Val").val(pase.puntuacio2_2 == null ? 0 : pase.puntuacio2_2).change();
            $("#item2ValText").text(pase.puntuacio2_2 == null ? 0 : pase.puntuacio2_2);
            $("#item3Val").val(pase.puntuacio3_2 == null ? 0 : pase.puntuacio3_2).change();
            $("#item3ValText").text(pase.puntuacio3_2 == null ? 0 : pase.puntuacio3_2);
            $("#item4Val").val(pase.puntuacio4_2 == null ? 0 : pase.puntuacio4_2).change();
            $("#item4ValText").text(pase.puntuacio4_2 == null ? 0 : pase.puntuacio4_2);
            $("#item5Val").val(pase.puntuacio5_2 == null ? 0 : pase.puntuacio5_2).change();
            $("#item5ValText").text(pase.puntuacio5_2 == null ? 0 : pase.puntuacio5_2);
            break;
        case 3:
            $("#item1Val").val(pase.puntuacio1_3 == null ? 0 : pase.puntuacio1_3).change();
            $("#item1ValText").text(pase.puntuacio1_3 == null ? 0 : pase.puntuacio1_3);
            $("#item2Val").val(pase.puntuacio2_3 == null ? 0 : pase.puntuacio2_3).change();
            $("#item2ValText").text(pase.puntuacio2_3 == null ? 0 : pase.puntuacio2_3);
            $("#item3Val").val(pase.puntuacio3_3 == null ? 0 : pase.puntuacio3_3).change();
            $("#item3ValText").text(pase.puntuacio3_3 == null ? 0 : pase.puntuacio3_3);
            $("#item4Val").val(pase.puntuacio4_3 == null ? 0 : pase.puntuacio4_3).change();
            $("#item4ValText").text(pase.puntuacio4_3 == null ? 0 : pase.puntuacio4_3);
            $("#item5Val").val(pase.puntuacio5_3 == null ? 0 : pase.puntuacio5_3).change();
            $("#item5ValText").text(pase.puntuacio5_3 == null ? 0 : pase.puntuacio5_3);
            break;
    }
    $("#puntuacioFinalText").text(((parseFloat($("#item1Val").val()) + parseFloat($("#item2Val").val()) + parseFloat($("#item3Val").val()) + parseFloat($("#item4Val").val()) + parseFloat($("#item5Val").val()))/5).toFixed(2));
    let nParticipants = 0;
    switch (lang) {
        case "ca-ES":
            $("#nPase").text("Paseº " + nPag);
            $("#categoria").text("Categoria: " + blocs[pase.idBloc].categoria.categoria + "-" + blocs[pase.idBloc].categoria.modalitat + "-" + blocs[pase.idBloc].categoria.estils + "-" + blocs[pase.idBloc].categoria.subcategoria);
            edat = 0;
            for (let i = 0; i < pase.participants.length; i++) {
                edat += pase.participants[i].edat;
                nParticipants++;
            }
            edat = edat / nParticipants;
            $("#edat").text("Edat: " + Math.floor(edat));
            $("#item1").text(punt1);
            $("#item2").text(punt2);
            $("#item3").text(punt3);
            $("#item4").text(punt4);
            $("#item5").text(punt5);
            $("#puntuacioFinal").text("Puntuació Final:");
            break;
        case "es-ES":
            $("#nPase").text("Paseº " + nPag);
            $("#categoria").text("Categoría: " + blocs[pase.idBloc].categoria.categoria + "-" + blocs[pase.idBloc].categoria.modalitat + "-" + blocs[pase.idBloc].categoria.estils + "-" + blocs[pase.idBloc].categoria.subcategoria);
            for (let i = 0; i < pase.participants.length; i++) {
                edat += pase.participants[i].edat;
                nParticipants++;
            }
            edat = edat / nParticipants;
            $("#edat").text("Edad: " + Math.floor(edat));
            $("#item1").text("Técnica");
            $("#item2").text("Musicalidad");
            $("#item3").text(punt3 == "Expressivitat i Comunicació" ? "Expresividad y Comunicación" : "Comunicación y Expresividad");
            if (punt4 == "Ús de l'espai"){
                $("#item4").text("Uso del espacio");
            } else if (punt4 == "Complicitat"){
                $("#item4").text("Complicidad");
            } else {
                $("#item4").text("Cohesión del grupo");
            }
            $("#item5").text(punt5 == "Coreografia" ? "Coreografía" : "Virtuosismo");
            $("#enviarVotacio").text("Enviar votación");
            $("#puntuacioFinal").text("Puntuación Final:");
            break;
        default:
            $("#nPase").text("Act num " + nPag);
            $("#categoria").text("Category: " + blocs[pase.idBloc].categoria.categoria + "-" + blocs[pase.idBloc].categoria.modalitat + "-" + blocs[pase.idBloc].categoria.estils + "-" + blocs[pase.idBloc].categoria.subcategoria);
            for (let i = 0; i < pase.participants.length; i++) {
                edat += pase.participants[i].edat;
                nParticipants++;
            }
            edat = edat / nParticipants;
            $("#edat").text("Age: " + Math.floor(edat));
            $("#item1").text("Technique");
            $("#item2").text("Musicality");
            $("#item3").text(punt3 == "Expressivitat i Comunicació" ? "Expressiveness and Communication" : "Communication and Expressiveness");
            if (punt4 == "Ús de l'espai"){
                $("#item4").text("Use of space");
            } else if (punt4 == "Complicitat"){
                $("#item4").text("Complicity");
            } else {
                $("#item4").text("Group cohesion");
            }
            $("#item5").text(punt5 == "Coreografia" ? "Choreography" : "Virtuosity");
            $("#enviarVotacio").text("Send vote");
            $("#puntuacioFinal").text("Final Score:");
            break;
        }
        $("#item1ValText").text
}
function pasarPase(seguent) {
    let pase = pases[paginaActual];
    switch (blocs[pase.idBloc].nJutge) {
        case 1:
            pase.puntuacio1_1 = $("#item1Val").val();
            pase.puntuacio2_1 = $("#item2Val").val();
            pase.puntuacio3_1 = $("#item3Val").val();
            pase.puntuacio4_1 = $("#item4Val").val();
            pase.puntuacio5_1 = $("#item5Val").val();
            break;
        case 2:
            pase.puntuacio1_2 = $("#item1Val").val();
            pase.puntuacio2_2 = $("#item2Val").val();
            pase.puntuacio3_2 = $("#item3Val").val();
            pase.puntuacio4_2 = $("#item4Val").val();
            pase.puntuacio5_2 = $("#item5Val").val();
            break;
        case 3:
            pase.puntuacio1_3 = $("#item1Val").val();
            pase.puntuacio2_3 = $("#item2Val").val();
            pase.puntuacio3_3 = $("#item3Val").val();
            pase.puntuacio4_3 = $("#item4Val").val();
            pase.puntuacio5_3 = $("#item5Val").val();
            break;
    }

    pases[paginaActual] = pase;
    if (seguent) {
        if (paginaActual < pases.length - 1) {
            paginaActual++;
            mostrarPagina(paginaActual + 1);
        }
    } else {
        if (paginaActual > 0) {
            paginaActual--;
            mostrarPagina(paginaActual + 1);
        }
    }
}

function enviarVotacio() {
    let pase = pases[paginaActual];
    let puntuacio1 = $("#item1Val").val();
    let puntuacio2 = $("#item2Val").val();
    let puntuacio3 = $("#item3Val").val();
    let puntuacio4 = $("#item4Val").val();
    let puntuacio5 = $("#item5Val").val()
    pases[paginaActual] = pase;
    $.ajax({
        url: '/enviarVotacio',
        type: 'POST',
        dataType: 'json',
        data: {
            idBloc : blocs[pase.idBloc].id,
            idPase : pase.id,
            nJutge : blocs[pase.idBloc].nJutge - 1,
            puntuacio1 : puntuacio1,
            puntuacio2 : puntuacio2,
            puntuacio3 : puntuacio3,
            puntuacio4 : puntuacio4,
            puntuacio5 : puntuacio5
        },
        success: function(data) {
            if (lang == "ca") {
                lang = "ca-ES";
            } else if (lang == "es") {
                lang = "es-ES";
            }
            if (data.success) {
                if (navigator.language == "ca-ES" || navigator.language == "ca") {
                    alert("Votació enviada correctament");
                } else if (navigator.language == "es-ES" || navigator.language == "es") {
                    alert("Votación enviada correctamente");
                } else {
                    alert("Vote sent correctly");
                }
            } else {
                if (navigator.language == "ca-ES" || navigator.language == "ca") {
                    alert("Error al enviar la votació");
                }
                else if (navigator.language == "es-ES" || navigator.language == "es") {
                    alert("Error al enviar la votación");
                } else {
                    alert("Error sending vote");
                }
            }
        }
    });
}

// Call this function to navigate to the next pase
function SeguentPase() {
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
