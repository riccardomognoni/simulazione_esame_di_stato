let lat="";
let lon="";

function getCoordinate(via,citta){
    var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(via+" "+citta);
          
    $.getJSON(url, function (data) {
        if (data && data.length > 0) {
           lat = data[0]["lat"];
            lon = data[0]["lon"];
            alert('Latitudine:'+ lat+ 'Longitudine:'+ lon);
        }
    });
}



function aggiungiStazione() {

    let nome = $("#nome").val();
    let numslot = $("#numslot").val();


    let via = $("#via").val();

    let citta = $("#citta").val();

    getCoordinate(via,citta);

    //richiesta ajax
    $.get("../ajax/addStation.php", { nome: nome, numslot: numslot, via: via,citta: citta, lat:lat,lon:lon }, function (data) {

        alert(data["message"]);
    }, 'json');
}

function modificaStazione(){
    let idStazione = $("#stazioni").val();
    let nome=$("#nomeMOD").val();

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

