<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <link href="../style/loginStyle.css" rel="stylesheet">
    <script src="../js/funzionalitaUtente.js"> </script>
    <script>
        $(document).ready(function () {
            $.get("../ajaxUtente/getOperazioni.php", {}, function (data) {
                let operazioni = data["message"].split(";");
                //controllo se effettua il json parse
                for (i = 0; i < operazioni.length - 1; i++) {
                    let operazione = operazioni[i].split(",");
                    $("#operazioni tbody").append(
                        "<tr>" +
                        "<td>" + operazione[0] + "</td>" +
                        "<td>" + operazione[1] + "</td>" +
                        "<td>" + operazione[2] + "</td>" +
                        "<td>" + operazione[3] + "</td>" +
                        "<td>" + operazione[4] + "</td>" +
                        "</tr>"
                    );
                }
            }, 'json');

            $.get("../ajaxUtente/getTratte.php", {}, function (data) {
                let operazioni = data["message"].split(";");
                //controllo se effettua il json parse
                for (i = 0; i < operazioni.length - 1; i++) {
                    let operazione = operazioni[i].split(",");
                    $("#tratte tbody").append(
                        "<tr>" +
                        "<td>" + operazione[0] + "</td>" +
                        "<td>" + operazione[1] + "</td>" +
                        "</tr>"
                    );
                }
            }, 'json');
        });
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }

        h2 {
            color: #333;
            margin-top: 0;
        }

        .table-container {
            width: 100%;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="table-container">
            <?php
            if (!isset($_SESSION))
                session_start();
            ?>
            <h2>Tratte effettuate</h2>
            <table id="tratte">
                <thead>
                    <tr>
                        <th>Tariffa (euro)</th>
                        <th>Distanza (Km)</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- I dati saranno aggiunti qui dinamicamente -->
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <h2>Operazioni effettuate</h2>
            <table id="operazioni">
                <thead>
                    <tr>
                        <th>Tipologia</th>
                        <th>Orario</th>
                        <th>Tariffa (euro)</th>
                        <th>Distanza (Km)</th>
                        <th>Stazione</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- I dati saranno aggiunti qui dinamicamente -->
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
