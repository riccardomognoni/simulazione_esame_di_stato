<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Noleggio bici</title>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style/main.css'>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        /* Stile per la mappa */
        #map {
            height: 400px;
            width: 100%;
        }
    </style>

    <script>
        // Funzione per inizializzare la mappa
        function maps() {
            // Creazione della mappa centrata su Milano
            var map = L.map('map').setView([45.7342403,9.1302528], 13);

            // Aggiunta del layer di OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Aggiunta di un marcatore su Milano
            L.marker([45.7342403,9.1302528]).addTo(map);
        }

        $(document).ready(function() {
            maps();
        });
    </script>
</head>

<body>
    <button onclick="window.location.href='pages/login.php'">Accedi</button>
    <button onclick="window.location.href='pages/registra.php'">Registrati</button>

    <!-- Contenitore per la mappa -->
    <div id="map"></div>
</body>

</html>
