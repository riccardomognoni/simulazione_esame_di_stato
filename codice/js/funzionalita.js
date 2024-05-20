function aggiungiStazione() {

    let nome = $("#nome").val();
    let numslot = $("#numslot").val();


    let via = $("#via").val();
    let cap = $("#cap").val();
    let regione = $("#regione").val();
    let provincia = $("#provincia").val();
    let citta = $("#citta").val();




    //richiesta ajax
    $.get("../ajax/insertUser.php", { nome: nome, numslot: numslot, via: via, cap: cap, citta: citta, provincia: provincia, regione: regione }, function (data) {

        alert(data["message"]);
    }, 'json');
}

function rimuoviStazione() {
    let idStazione = $("#stazioni").val();
    //richiesta ajax
    if (confirm("Vuoi eliminare questa Stazione?") == true){

    $.get("../ajax/removeStation.php", { stazione: idStazione }, function (data) {

        alert(data["message"]);
    }, 'json');
}
}

