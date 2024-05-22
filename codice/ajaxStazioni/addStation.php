<?php
header('Content-Type: application/json');
require_once ("../database/credenziali.php");

global $host, $user, $psw, $dbname;


//connessione al database
$conn = new mysqli($host, $user, $psw, $dbname);
if ($conn->connect_error) {
    throw new Exception("Connection failed: " . $conn->connect_error);
}

$nome = $_GET["nome"];
$numslot=$_GET["numslot"];


$via = $_GET["via"];
$citta = $_GET["citta"];
$lat=$_GET["lat"];
$lon=$_GET["lon"];

$idIndirizzo;
$sql = "SELECT * FROM indirizzo WHERE via = ? AND citta = ?";
$stmt = $conn->prepare($sql);

//metto i parametri
$stmt->bind_param("ss", $via, $cap);
$stmt->execute();


//controllo se ha trovato qualcosa
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if ($result->num_rows == 1) {
    $idIndirizzo = $row["ID"];
} else {
    $sql = "INSERT INTO `indirizzo`(`via`, `citta`, `latitudine`, `longitudine`) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);

    //metto i parametri
    $stmt->bind_param("ssss", $via, $citta, $lat, $lon);
    $stmt->execute();
    $idIndirizzo = mysqli_insert_id($conn);
}

$sql = "INSERT INTO `stazione`(`nome`, `numero_slot`, `IDindirizzo`) VALUES (?,?,?)";
$stmt = $conn->prepare($sql);

//metto i parametri
$stmt->bind_param("ssi", $nome, $numslot,$idIndirizzo);



if ($stmt->execute()) {
    //salvo la variabile username in sessione

    $arr = array("status" => "ok", "message" => "stazione aggiunta correttamente");
    echo json_encode($arr);

}else {
    $arr = array("status" => "ko", "message" => "errore nella registrazione");
    echo json_encode($arr);
}

