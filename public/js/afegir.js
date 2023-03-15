var dadesPersonals = false;
var dadesCategoria = false;
var dadesgrup = false;

window.onload = function () {
    $("#fitxerCSV").on("change", function () {
        if ($(this).val() == "") {
            $("button").prop("disabled", true);
        } else {
            if ($(this).val().split(".").pop().toLowerCase() != "csv") {
                alert("El fitxer no és un .csv");
                $("button").prop("disabled", true);
                $(this).val("");
            } else {
                $("button").prop("disabled", false);
            }
        }
    });
    $(".toast").toast({ delay: 50000 });
    $(".toast").toast("show");
    $("#nom").on("change", function () {
        if ($.isNumeric($(this).val())) {
            $("#idParticipant").val($(this).val());
            let opcio = $('#noms option[value="' + $(this).val() + '"]')
            let nom = opcio.text();
            let cognoms = nom.split(", ");
            let id = $(this).val();
            $("#nom").val(cognoms[0]);
            $("#cognoms").val(cognoms[1]);
            let edat = opcio.attr("data-edat");
            $("#edat").val(edat);
            dadesPersonals = true;
            comprovarFormulari();
        } else if ($(this).val() == "") {
            $("#idParticipant").val("");
            $("#cognoms").val("");
            $("#edat").val("");
            dadesPersonals = false;
            $("#submit").prop("disabled", true);
        } else {
            $("#idParticipant").val("");
            dadesPersonals = true;
            comprovarFormulari();
        }
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
            dadesCategoria = false;
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
            dadesCategoria = false;
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
            dadesCategoria = false;
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
                dadesCategoria = false;
            } else {
                if ($("#modalitat").val() == 2) {
                        let subcategoria = document.createElement("option");
                        subcategoria.value = 1;
                        subcategoria.text = "C" + 0;
                        $("#subcategoria").append(subcategoria);
                        $("#subcategoria").val(1).change();
                        dadesCategoria = true;
                        comprovarFormulari();
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
                    dadesCategoria = false;
                }
            }
        } else {
            netejarSubCategories();
            $("#subcategoria").val("0").change();
            $("#submit").prop("disabled", true);
            dadesCategoria = false;
        }
    });
    $("#subcategoria").on("change", function () {
        if ($(this).val() != "") {
            dadesCategoria = true;
            comprovarFormulari();
        }
    });
    $("#nomGrup").on("change", function () {
        if ($.isNumeric($(this).val())) {
            let idgrup = $(this).val();
            let nom = $("#grups option[value='" + idgrup + "']").text();
            $("#idGrup").val(idgrup);
            $("#nomGrup").val(nom);
            dadesgrup = true;
            comprovarFormulari();
        } else if ($(this).val() == "") {
            $("#submit").prop("disabled", true);
            dadesgrup = false;
        } else {
            dadesgrup = true;
            comprovarFormulari();
        }
    });
    $("#submit").on("click", function () {
        $("#subcategoria").prop("disabled", false);
    });
};

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

function comprovarFormulari() {
    if (dadesCategoria && dadesgrup && dadesPersonals) {
        $("#submit").prop("disabled", false);
    } else {
        $("#submit").prop("disabled", true);
    }
}
