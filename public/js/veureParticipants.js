var nomparticipant = true;
var cognoms = false;
var edat = false;
var categoria = false;
var estil = false;
var modalitat = false;
var subCategoria = false;
var nomBall = false;
var nPase = false;
var toastElList = document.querySelectorAll('.toast');
var toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));
var toast1 = toastList[0];



window.onload = function() {
    toastElList = document.querySelectorAll('.toast');
    toastList = [...toastElList].map(toastEl => new bootstrap.Toast(toastEl));
    toast1 = toastList[0];
    $("#nomParticipant").click(function() {
        $("#tbody").hide();
        toast1.show();
        setTimeout(ordenarNom, 170);
    });
    $("#cognoms").click(cognoms);
    $("#edat").click(edat);
    $("#categoria").click(categoria);
    $("#estil").click(estil);
    $("#modalitat").click(modalitat);
    $("#subCategoria").click(subCategoria);
    $("#nomBall").click(nomBall);
    $("#nPase").click(nPase);
}

function ordenarNom() {
    const time = Date.now();
    $("#tbody").hide();
    if (nomparticipant) {
        //Ordena ascendent
        let taula, files, switching, i, x, y, shouldSwitch;
        taula = document.getElementById("taula");
        switching = true;
        while (switching) {
            switching = false;
            files = taula.rows;
            for (i = 1; i < (files.length - 1); i++) {
                shouldSwitch = false;
                compa1 = files[i].getElementsByTagName("TD")[0];
                compa2 = files[i + 1].getElementsByTagName("TD")[0];
                compa1 = compa1.innerHTML.toLowerCase();
                compa2 = compa2.innerHTML.toLowerCase();
                compa1 = compa1.replace("à", "a");
                compa2 = compa2.replace("à", "a");
                compa1 = compa1.replace("è", "e");
                compa2 = compa2.replace("è", "e");
                compa1 = compa1.replace("é", "e");
                compa2 = compa2.replace("é", "e");
                compa1 = compa1.replace("í", "i");
                compa2 = compa2.replace("í", "i");
                compa1 = compa1.replace("ó", "o");
                compa2 = compa2.replace("ó", "o");
                compa1 = compa1.replace("ò", "o");
                compa2 = compa2.replace("ò", "o");
                compa1 = compa1.replace("ú", "u");
                compa2 = compa2.replace("ú", "u");
                if (compa1 > compa2) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                files[i].parentNode.insertBefore(files[i + 1], files[i]);
                switching = true;
            }
        }
        nomparticipant = false;
    } else {
        //Ordena descendent
        let taula, files, switching, i, x, y, shouldSwitch;
        taula = document.getElementById("taula");
        switching = true;
        while (switching) {
            switching = false;
            files = taula.rows;
            for (i = 1; i < (files.length - 1); i++) {
                shouldSwitch = false;
                compa1 = files[i].getElementsByTagName("TD")[0];
                compa2 = files[i + 1].getElementsByTagName("TD")[0];
                //Si porta accent cambia el codi de la condició per la del caracter sense accent
                compa1 = compa1.innerHTML.toLowerCase();
                compa2 = compa2.innerHTML.toLowerCase();
                compa1 = compa1.replace("à", "a");
                compa2 = compa2.replace("à", "a");
                compa1 = compa1.replace("è", "e");
                compa2 = compa2.replace("è", "e");
                compa1 = compa1.replace("é", "e");
                compa2 = compa2.replace("é", "e");
                compa1 = compa1.replace("í", "i");
                compa2 = compa2.replace("í", "i");
                compa1 = compa1.replace("ó", "o");
                compa2 = compa2.replace("ó", "o");
                compa1 = compa1.replace("ò", "o");
                compa2 = compa2.replace("ò", "o");
                compa1 = compa1.replace("ú", "u");
                compa2 = compa2.replace("ú", "u");
                if (compa1 < compa2) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                files[i].parentNode.insertBefore(files[i + 1], files[i]);
                switching = true;
            }
        }
        nomparticipant = true;
    }
    console.log("Temps d'execució: " + (Date.now() - time) + "ms");
    $("#tbody").show();
}

function cognoms() {
    const time = Date.now();
    if (cognoms) {
        //Ordena ascendent
        let taula, files, switching, i, x, y, shouldSwitch;
        taula = document.getElementById("taula");
        switching = true;
        while (switching) {
            switching = false;
            files = taula.rows;
            for (i = 1; i < (files.length - 1); i++) {
                shouldSwitch = false;
                compa1 = files[i].getElementsByTagName("TD")[1];
                compa2 = files[i + 1].getElementsByTagName("TD")[1];
                compa1 = compa1.innerHTML.toLowerCase();
                compa2 = compa2.innerHTML.toLowerCase();
                compa1 = compa1.replace("à", "a");
                compa2 = compa2.replace("à", "a");
                compa1 = compa1.replace("è", "e");
                compa2 = compa2.replace("è", "e");
                compa1 = compa1.replace("é", "e");
                compa2 = compa2.replace("é", "e");
                compa1 = compa1.replace("í", "i");
                compa2 = compa2.replace("í", "i");
                compa1 = compa1.replace("ó", "o");
                compa2 = compa2.replace("ó", "o");
                compa1 = compa1.replace("ò", "o");
                compa2 = compa2.replace("ò", "o");
                compa1 = compa1.replace("ú", "u");
                compa2 = compa2.replace("ú", "u");
                if (compa1 > compa2) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                files[i].parentNode.insertBefore(files[i + 1], files[i]);
                switching = true;
            }
        }
        cognoms = false;
    } else {
        //Ordena descendent
        let taula, files, switching, i, x, y, shouldSwitch;
        taula = document.getElementById("taula");
        switching = true;
        while (switching) {
            switching = false;
            files = taula.rows;
            for (i = 1; i < (files.length - 1); i++) {
                shouldSwitch = false;
                compa1 = files[i].getElementsByTagName("TD")[1];
                compa2 = files[i + 1].getElementsByTagName("TD")[1];
                //Si porta accent cambia el codi de la condició per la del caracter sense accent
                compa1 = compa1.innerHTML.toLowerCase();
                compa2 = compa2.innerHTML.toLowerCase();
                compa1 = compa1.replace("à", "a");
                compa2 = compa2.replace("à", "a");
                compa1 = compa1.replace("è", "e");
                compa2 = compa2.replace("è", "e");
                compa1 = compa1.replace("é", "e");
                compa2 = compa2.replace("é", "e");
                compa1 = compa1.replace("í", "i");
                compa2 = compa2.replace("í", "i");
                compa1 = compa1.replace("ó", "o");
                compa2 = compa2.replace("ó", "o");
                compa1 = compa1.replace("ò", "o");
                compa2 = compa2.replace("ò", "o");
                compa1 = compa1.replace("ú", "u");
                compa2 = compa2.replace("ú", "u");
                if (compa1 < compa2) {
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                files[i].parentNode.insertBefore(files[i + 1], files[i]);
                switching = true;
            }
        }
        cognoms = true;
    }
    console.log("Temps d'execució: " + (Date.now() - time) + "ms");
}

function edat() {

}

function categoria() {

}

function estil() {

}

function modalitat() {

}

function subCategoria() {

}

function nomBall() {

}

function nPase() {

}