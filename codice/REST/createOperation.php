<?php
header('Content-Type: application/json');
require_once ("../database/credenziali.php");

global $host, $user, $psw, $dbname;


//connessione al database
$conn = new mysqli($host, $user, $psw, $dbname);
if ($conn->connect_error) {
    throw new Exception("Connection failed: " . $conn->connect_error);
}
$idUtente = $_GET["IDutente"];
$idBici = $_GET["IDbici"];
$idStazione = $_GET["IDstazione"];

$operazione = $_GET["operazione"];
$distanza = $_GET["distanza"];
$tariffa = $distanza * 0.80;
$ora = date('Y/m/d H:i:s');

if ($operazione == "riconsegna") {
    $sql = "SELECT `KMtotali` FROM `bicicletta` WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idBici);

    $stmt->execute();

    $km = 0;

    //controllo se ha trovato qualcosa
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($result->num_rows == 1) {

        $km = $row["KMtotali"];
    }

    $sql = "UPDATE `bicicletta` SET `KMtotali`=? WHERE ID=$idBici";
    $stmt = $conn->prepare($sql);

    $km = $km + $distanza;
    $stmt->bind_param("i", $km);

    $stmt->execute();
}

if ($idUtente == 0) {
    $sql = "INSERT INTO `operazione`(`tipo`, `orario`, `tariffa`, `distanza_percorsa`, `IDbicicletta`, `IDstazione`) VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);

    //metto i parametri
    $stmt->bind_param("ssddii", $operazione, $ora, $tariffa, $distanza, $idBici, $idStazione);
} else {
    $sql = "INSERT INTO `operazione`(`tipo`, `orario`, `tariffa`, `distanza_percorsa`, `IDcliente`, `IDbicicletta`, `IDstazione`) VALUES (?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);

    //metto i parametri
    $stmt->bind_param("ssddiii", $operazione, $ora, $tariffa, $distanza, $idUtente, $idBici, $idStazione);
}




if ($stmt->execute()) {
    //salvo la variabile username in sessione

    $arr = array("status" => "ok", "message" => "operazione aggiunta");
    echo json_encode($arr);

} else {
    $arr = array("status" => "ko", "message" => "errore nell eseguzione");
    echo json_encode($arr);
}


