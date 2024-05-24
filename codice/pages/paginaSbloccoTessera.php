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
            $.get("../ajaxAdmin/getUtentiBloccati.php", {}, function (data) {
             
                let tessere=data["message"].split(";");
           //controllo se effettua il json parse
                for(i=0;i<tessere.length-1;i++){
                    let tessera=tessere[i].split(",");
                    $('#tessere').append($('<option></option>').val(tessera[0]).text(tessera[1]+" "+tessera[2]));

                    $("#utenti tbody").append(
                        "<tr>" +
                        "<td>" + tessera[1] + "</td>" +
                        "<td>" + tessera[2] + "</td>" +
                        "<td>" + tessera[3] + "</td>" +
                        "</tr>"
                    );
                }

            }, 'json');
        })
    </script>

    <script>
        function rigeneraTessera(){
            let utente=$("#tessere").val();
            $.get("../ajaxAdmin/rigeneraTessera.php", {IDutente:utente}, function (data) {
                alert(data["message"]);
                location.reload();
            }, 'json');

        }
    </script>
</head>

<style>
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

<body>
    <div class="container">
        <div id="formLogin" class="form-box" style="width:500px">
            <?php
            if (!isset($_SESSION))
                session_start();
            ?>
            <h2>Utenti con la tessera bloccata </h2>
            <div class="table-container">
                <table id="utenti">
                  
                        <td>Nome</td>
                        <td>Cognome</td>
                        <td>Num Tessera</td>
                
           
                </table>
            </div>
            Rigenera tessera <br>
            <select name="" id="tessere"></select>
            <button class="b" type="button" onclick=" rigeneraTessera()">Rigenera</button><br><br>
        </div>
    </div>
</body>

</html>