<html>

<head>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!--per la password-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <link href="../style/pagineIniziali.css" rel="stylesheet">
    <script src="../js/login.js"> </script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    <script>
        function goToStazioni() {
            window.location.href = "paginaStazioni.php";
        }
        function goToBici() {
            window.location.href = "paginaBici.php";
        }
        function goToTessereBloccate(){
            window.location.href = "paginaSbloccoTessera.php";
        }
    </script>

    <script>
        // Funzione per inizializzare la mappa
        function maps() {
            // Creazione della mappa centrata su Milano
            var map = L.map('map').setView([45.7342403, 9.1302528], 13);

            // Aggiunta del layer di OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            $.get("../ajaxStazioni/getCoordinate.php", {}, function (data) {
                let stazioni = data["message"].split(";");
                // controllo se effettua il json parse
                for (i = 0; i < stazioni.length - 1; i++) {
                    let stazione = stazioni[i].split(",");
                    // Aggiunta di un marcatore su Milano
                    let marker = L.marker([stazione[0], stazione[1]]).addTo(map);
                    marker.bindPopup("<b>" + stazione[2] + "</b><br><i>"+stazione[3]+"</i>");
                    marker.on('click', function () {
                        marker.openPopup();
                    });
                }
            }, 'json');
        }

        $(document).ready(function () {
            maps();
        });
    </script>
</head>

<body>
    <div class="navbar">
        <?php
        //controllo sessione
        if (!isset($_SESSION))
            session_start();
        ?>
        <h2>BENVENUTO <?php echo $_SESSION["nome_cognome"] ?> </h2>

        <div class="buttons">
            <button class="b" type="button" onclick="goToStazioni()">Aggiungi/Rimuovi Stazione</button><br><br>
            <button class="b" type="button" onclick="goToBici()">Aggiungi/Rimuovi Bicicletta</button><br><br>
            <button class="b" type="button" onclick="goToTessereBloccate()">Visualizza tessere bloccate</button><br><br>
            <button class="b" type="button" onclick="logout()">logout</button><br><br>
        </div>
    </div>

    <div class="container">
        <div id="map"></div>
    </div>
    
</body>

</html>