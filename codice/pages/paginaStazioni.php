<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <link href="../style/loginStyle.css" rel="stylesheet">
    <script src="../js/funzionalitaStazioni.js"> </script>
    <script>
        $(document).ready(function(){
            $.get("../ajax/getStazioni.php", {}, function (data) {
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
            <h2>Aggiungi Stazione</h2>
            <input type="text" name="nome" id="nome" placeholder="Nome" required><br>
            <input type="number" name="numslot" id="numslot" placeholder="Numero di slot" required><br>
            <label for="via">Indirizzo:</label>
            <input type="text" name="" id="via" placeholder="Via" required><br>
            <input type="text" name="" id="citta" placeholder="Città" required><br>

            <button class="b" type="button" onclick="aggiungiStazione()">Aggiungi</button><br><br>
        </div>

        <div id="formRemove" class="form-box">
            <h2>Modfica Stazione</h2>
            <select name="" id="stazioni"></select>
            <input type="text" id="nomeMOD" placeholder="nome">
            <input type="number" name="numslot" id="numslotMOD" placeholder="Numero di slot" required><br>


            <button  type="button" onclick="modificaStazione()">Modifica</button><br><br>
            <button class="remove-button b" type="button" onclick="rimuoviStazione()">Rimuovi</button><br><br>
        </div>
    </div>
</body>

</html>