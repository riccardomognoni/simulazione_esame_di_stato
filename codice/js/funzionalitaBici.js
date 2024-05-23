function aggiungiBici() {

    let gps = $("#gps").val();
    let rfid = $("#rfid").val();


    let stazione = $("#stazioni").val();


    let idutente=0;
    let operazione="riconsegna";
    let distanza=0;
    //richiesta ajax
    $.get("../ajaxBici/addBici.php", { gps: gps, rfid: rfid }, function (data) {

        alert(data["message"]);
        //richiesta ajax
        idbici=data["message"];
        $.get("../REST/createOperation.php", { operazione: operazione, distanza: distanza, IDutente: idutente,IDbici: idbici, IDstazione: stazione }, function (data) {

            alert(data["message"]);
            location.reload();
        }, 'json');
    }, 'json');






}

function modificaBici() {
    let bici = $("#bici").val();
    let gps = $("#gpsMOD").val();
    let rfid = $("#rfidMOD").val();

    if (nome == "" && slot == "") {
        alert("compila almeno un campo")
    } else {
        $.get("../ajaxStazioni/updateStation.php", { gps: gps, rfid: rfid, bici: bici }, function (data) {

            alert(data["message"]);
            location.reload();
        }, 'json');
    }

}

function rimuoviBici() {
    let bici = $("#bici").val();
    //richiesta ajax
    if (confirm("Vuoi eliminare questa bicicletta?") == true) {

        $.get("../ajaxBici/removeBici.php", { bici: bici }, function (data) {

            alert(data["message"]);
            location.reload();
        }, 'json');
    }
}

