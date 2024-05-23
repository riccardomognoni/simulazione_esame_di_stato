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
$ora = date('d/m/Y H:i');



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

