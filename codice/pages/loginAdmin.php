<html>

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!--per la password-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <link href="../style/style.css" rel="stylesheet">
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
        <h2>LOGIN </h2>
        <input type="text" name="username" id="email" placeholder="email"><br>
        <input type="password" name="password" id="password" placeholder="password"><br>
        <button class="b" type="button" onclick="login('a')">Login</button><br><br>
    </div>
</body>

</html>