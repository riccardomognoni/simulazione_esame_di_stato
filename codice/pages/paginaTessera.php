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
               
                $("#tessera").text(utente[6]);

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
          Numero tessera: <label for="" id="tessera"></label> <br><br>
            <button class="b" type="button" onclick=" bloccaTessera()">Blocca tessera</button><br><br>
        </div>
    </div>
</body>

</html>