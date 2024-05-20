<html>

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!--per la password-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <link href="../style/loginStyle.css" rel="stylesheet">
    <script src="../js/funzionalita.js"> </script>
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
    <div id="formLogin">
        <?php
        //controllo sessione
        if (!isset($_SESSION))
            session_start();
        ?>
        <h2>Aggiungi Stazione</h2>
        <input type="text" name="nome" id="nome" placeholder="nome" required><br>
        <input type="number" name="numslot" id="numslot" placeholder="numero di slot" required><br>

        Indirizzo:
        <input type="text" name="" id="via" placeholder="via" required><br>
        <input type="text" name="" id="citta" placeholder="città" required><br>
        <input type="text" name="" id="provincia" placeholder="provincia" required><br>
        <input type="text" name="" id="cap" placeholder="CAP" required><br>
        <input type="text" name="" id="regione" placeholder="regione" required><br>
        <button class="b" type="button" onclick="aggiungiStazione()">Aggiungi</button><br><br>



        
        <h2>Rimuovi Stazione</h2>
        <select name="" id="stazioni"></select>
        <button class="b" type="button" onclick="rimuoviStazione()">Rimuovi</button><br><br>
    </div>
</body>

</html>