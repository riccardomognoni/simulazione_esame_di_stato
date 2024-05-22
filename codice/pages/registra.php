<html>

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!--per la password-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <link href="../style/loginStyle.css" rel="stylesheet">
    <script src="../js/login.js">


    </script>

    <script>
     


        function registra() {
            //prendo e controllo se i campi sono compilati
            let email = $("#email").val();
            let pass = $("#password").val();
            let nome = $("#nome").val();
            let cognome = $("#cognome").val();
            let carta_credito = $("#carta_credito").val();


            let via = $("#via").val();
            let citta = $("#citta").val();



            if (email == "" || pass == "") {
                alert("Compila tutti i campi!");
            }
            //vado avanti
            else {
                //crypta password
                let pswMD5 = CryptoJS.MD5(pass).toString();
                var url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(via + " " + citta);

                $.getJSON(url, function (data) {
                    if (data && data.length > 0) {
                        lat = data[0]["lat"];
                        lon = data[0]["lon"];
                        alert('Latitudine:' + lat + 'Longitudine:' + lon);

                        $.get("../ajax/insertUser.php", {
                    email: email, pass: pswMD5, nome: nome, cognome: cognome,
                    carta_credito: carta_credito, via: via, citta: citta, lat: lat, lon: lon
                }, function (data) {
                    //controllo se effettua il json parse

                    alert(data["message"]);



                }, 'json');
                    }
                });
                //richiesta ajax
              
            }
        }
    </script>

</head>

<body>
    <div class="container">
    <div id="formLogin" class="form-box">
        <?php
        //controllo sessione
        if (!isset($_SESSION))
            session_start();
        ?>
        <h2>REGISTRATI</h2>
        <input type="text" name="username" id="nome" placeholder="nome"><br>
        <input type="text" name="password" id="cognome" placeholder="cognome"><br>
        <input type="text" name="username" id="email" placeholder="email"><br>
        <input type="password" name="password" id="password" placeholder="password"><br>
        <input type="text" name="" id="carta_credito" placeholder="numero di carta di credito"><br>
        Indirizzo:
        <input type="text" name="" id="via" placeholder="via"><br>
        <input type="text" name="" id="citta" placeholder="città"><br>
        <button class="b" type="button" onclick="registra()">Registrati</button><br><br>
    </div>
    </div>
</body>

</html>