<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <link href="../style/loginStyle.css" rel="stylesheet">
    <script src="../js/funzionalitaUtente.js"> </script>
    <script>
        $(document).ready(function () {
            $.get("../ajaxUtente/getDati.php", {}, function (data) {
             
                let utente = data["message"].split(";");
                //controllo se effettua il json parse
               

                $("#nome").val(utente[0]);
                $("#cognome").val(utente[1]);
                $("#email").val(utente[2]);
                $("#carta_credito").val(utente[3]);
                $("#via").val(utente[4]);
                $("#citta").val(utente[5]);

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
            <h2><?php echo $_SESSION["nome_cognome"]; ?> </h2>
            <input type="text" name="username" id="nome" placeholder="nome"><br>
            <input type="text" name="password" id="cognome" placeholder="cognome"><br>
            <input type="text" name="username" id="email" placeholder="email"><br>
            <input type="password" name="password" id="password" placeholder="password"><br>
            <input type="text" name="" id="carta_credito" placeholder="numero di carta di credito"><br>
            Indirizzo:
            <input type="text" name="" id="via" placeholder="via"><br>
            <input type="text" name="" id="citta" placeholder="città"><br>

            <button class="b" type="button" onclick=" aggiornaDati()">Modifica</button><br><br>
        </div>
    </div>
</body>

</html>