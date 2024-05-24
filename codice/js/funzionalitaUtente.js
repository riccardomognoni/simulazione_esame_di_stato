function aggiornaDati(){
    let email = $("#email").val();
    let pass = $("#password").val();
    let nome = $("#nome").val();
    let cognome = $("#cognome").val();
    let carta_credito = $("#carta_credito").val();


    let via = $("#via").val();
    let citta = $("#citta").val();



    if (email == "" || nome=="" || cognome=="" || carta_credito=="" || via=="" || citta=="") {
        alert("Compila tutti i campi!");
    }
    //vado avanti
    else {
        let pswMD5="";
        //crypta password
        if(pass!=""){
            pswMD5 = CryptoJS.MD5(pass).toString();
        }
        var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(via + " " + citta);

        $.getJSON(url, function (data) {
            if (data && data.length > 0) {
                lat = data[0]["lat"];
                lon = data[0]["lon"];
              

                $.get("../ajaxUtente/updateDati.php", {
            email: email, pass: pswMD5, nome: nome, cognome: cognome,
            carta_credito: carta_credito, via: via, citta: citta, lat: lat, lon: lon}, function (data) {
            //controllo se effettua il json parse

            alert(data["message"]);
           location.reload();


        }, 'json');
            }
        });
        //richiesta ajax
      
    }
 
}


function bloccaTessera(){
    $.get("../ajaxUtente/bloccaTessera.php", {}, function (data) {

        alert(data["message"]);
       location.reload();


    }, 'json');
}