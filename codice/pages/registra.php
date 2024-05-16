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
            let cap = $("#cap").val();
            let regione = $("#regione").val();
            let provincia = $("#provincia").val();
            let citta = $("#citta").val();




            if (email == "" || pass == "") {
                alert("Compila tutti i campi!");
            }
            //vado avanti
            else {
                //crypta password
                let pswMD5 = CryptoJS.MD5(pass).toString();
                //richiesta ajax
                $.get("../ajax/insertUser.php", { email: email, pass: pswMD5, nome:nome, cognome:cognome, 
                    carta_credito:carta_credito, via:via, cap:cap, citta:citta, provincia:provincia, regione:regione }, function (data) {
                    //controllo se effettua il json parse
                 
                        alert(data["message"]);
                    


                }, 'json');
            }
        }
    </script>

</head>

<body>
    <div id="formLogin">
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
        <input type="text" name="" id="provincia" placeholder="provincia"><br>
        <input type="text" name="" id="cap" placeholder="CAP"><br>
        <input type="text" name="" id="regione" placeholder="regione"><br>
        <button class="b" type="button" onclick="registra()">Registrati</button><br><br>
    </div>
</body>

</html>