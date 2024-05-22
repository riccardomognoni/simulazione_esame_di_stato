



function aggiungiStazione() {

    let nome = $("#nome").val();
    let numslot = $("#numslot").val();


    let via = $("#via").val();

    let citta = $("#citta").val();

    var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(via+" "+citta);
          
    $.getJSON(url, function (data) {
        if (data && data.length > 0) {
           lat = data[0]["lat"];
            lon = data[0]["lon"];
            //richiesta ajax
    $.get("../ajaxStazioni/addStation.php", { nome: nome, numslot: numslot, via: via,citta: citta, lat:lat,lon:lon }, function (data) {

        alert(data["message"]);
        location.reload();
    }, 'json');
        }
    });

   
}

function modificaStazione(){
    let idStazione = $("#stazioni").val();
    let nome=$("#nomeMOD").val();
    let slot=$("#numslotMOD").val();

    if(nome=="" && slot==""){
        alert("compila almeno un campo")
    }else{
        $.get("../ajaxStazioni/updateStation.php", { nome: nome, slot: slot,stazione:idStazione }, function (data) {

            alert(data["message"]);
            location.reload();
        }, 'json');
    }

}

function rimuoviStazione() {
    let idStazione = $("#stazioni").val();
    //richiesta ajax
    if (confirm("Vuoi eliminare questa Stazione?") == true){

    $.get("../ajaxStazioni/removeStation.php", { stazione: idStazione }, function (data) {

        alert(data["message"]);
        location.reload();
    }, 'json');
}
}

