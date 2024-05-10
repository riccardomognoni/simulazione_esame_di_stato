<html>

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!--per la password-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <link href="../style/loginStyle.css" rel="stylesheet">
    <script src="../js/login.js">



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
        <input type="text" name="username" id=" nome" placeholder="nome"><br>
        <input type="password" name="password" id="cognome" placeholder="cognome"><br>
        <input type="text" name="username" id="email" placeholder="email"><br>
        <input type="password" name="password" id="password" placeholder="password"><br>
        <input type="text" name="" id=" carta_credito" placeholder="numero di carta di credito"><br>
        Indirizzo:
        <input type="text" name="" id=" via" placeholder="via"><br>
        <input type="text" name="" id="citta" placeholder="città"><br>
        <input type="text" name="" id="provincia" placeholder="provincia"><br>
        <input type="text" name="" id="cap" placeholder="CAP"><br>
        <input type="text" name="" id=" regione" placeholder="regione"><br>
        <button class="b" type="button" onclick="login('a')">Registrati</button><br><br>
    </div>
</body>

</html>