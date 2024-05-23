<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Noleggio bici</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style/main.css'>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    <script>
        // Funzione per inizializzare la mappa
        function maps() {
            // Creazione della mappa centrata su Milano
            var map = L.map('map').setView([45.7342403, 9.1302528], 13);

            // Aggiunta del layer di OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            $.get("ajaxStazioni/getCoordinate.php", {}, function (data) {
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
        <h1>Noleggio Bici</h1>
        <div>
            <button onclick="window.location.href='pages/login.php'">Accedi</button>
            <button onclick="window.location.href='pages/registra.php'">Registrati</button>
        </div>
    </div>

    <!-- Contenitore per la mappa -->
    <div id="map"></div>
</body>

</html>
