<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <link href="../style/loginStyle.css" rel="stylesheet">
    <script src="../js/funzionalitaBici.js"> </script>
    <script>
        $(document).ready(function(){
            $.get("../ajaxBici/getBici.php", {}, function (data) {
                let stazioni=data["message"].split(";");
           //controllo se effettua il json parse
                for(i=0;i<stazioni.length-1;i++){
                    let stazione=stazioni[i].split(",");
                    $('#bici').append($('<option></option>').val(stazione[0]).text(stazione[1]));
                }
              
	
	
        }, 'json');

        $.get("../ajaxStazioni/getStazioni.php", {}, function (data) {
                let stazioni=data["message"].split(";");
           //controllo se effettua il json parse
                for(i=0;i<stazioni.length-1;i++){
                    let stazione=stazioni[i].split(",");
                    $('#stazioni').append($('<option></option>').val(stazione[0]).text(stazione[1]));
                }
              
	
	
        }, 'json');
        })
    </script>
</head>

<body>
    <div class="container">
        <div id="formLogin" class="form-box">
            <?php
            if (!isset($_SESSION))
                session_start();
            ?>
            <h2>Aggiungi Bicicletta</h2>
            <input type="text" name="nome" id="gps" placeholder="GPS" required><br>
            <input type="text" name="numslot" id="rfid" placeholder="RFID" required><br>
            <select name="" id="stazioni"></select>
            <button class="b" type="button" onclick="aggiungiBici()">Aggiungi</button><br><br>
        </div>

        <div id="formRemove" class="form-box">
            <h2>Modfica Bicicletta</h2>
            <select name="" id="bici"></select>
            <input type="text" id="gpsMOD" placeholder="GPS">
            <input type="text" name="" id="rfidMOD" placeholder="RFID" required><br>


            <button  type="button" onclick="modificaBici()">Modifica</button><br><br>
            <button class="remove-button b" type="button" onclick="rimuoviBici()">Rimuovi</button><br><br>
        </div>
    </div>
</body>

</html>