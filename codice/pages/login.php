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
<div class="container">
    <div id="formLogin" class="form-box" >
        <?php
        //controllo sessione
        if (!isset($_SESSION))
            session_start();
        ?>
        <h2>LOGIN </h2>
        <input type="text" name="" id="email" placeholder="email"><br>
        <input type="password" name="password" id="password" placeholder="password"><br>
        <button class="b" type="button" onclick="login('c')">Login</button><br><br>
        <a href="loginAdmin.php">Sei un amministratore? accedi alla tua area privata</a>
    </div>
</div>
</body>

</html>