<html>

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!--per la password-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <link href="../style/loginStyle.css" rel="stylesheet">
    <script src="../js/login.js"> </script>

    <script>
        function goToStazioni(){
            window.location.href="paginaStazioni.php";
        }
        function goToBici(){
            window.location.href="paginaBici.php";
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
        <h2>BENVENUTO <?php echo $_SESSION["nome_cognome"]?> </h2>
      
        
        <button class="b" type="button" onclick="goToStazioni()">Aggiungi/Rimuovi Stazione</button><br><br>
        <button class="b" type="button" onclick="goToBici()">Aggiungi/Rimuovi Bicicletta</button><br><br>
        <button class="b" type="button" onclick="logout()">logout</button><br><br>
    </div>
    </div>
</body>

</html>