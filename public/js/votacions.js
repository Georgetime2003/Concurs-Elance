var pases = [];
var paginaActual = 0; // Initialize with 0 to match array indexing

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
            pases = data; // Store the retrieved pases
            mostrarPase(paginaActual);
            console.log(data);
        }
    });
});

function mostrarPase(index) {
    if (index >= 0 && index < pases.length) {
        var pase = pases[index];
        $("#nPase").html("Pase Nº " + pase.id);
        $("#categoria").html(pase.categoria);
        $("#edat").html(pase.edat);
        // Add code for other fields
        
        // Example: $("#item1").html(pase.item1);
    }
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
