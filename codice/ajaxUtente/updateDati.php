<?php
header('Content-Type: application/json');
require_once ("../database/credenziali.php");

global $host, $user, $psw, $dbname;


//connessione al database
$conn = new mysqli($host, $user, $psw, $dbname);
if ($conn->connect_error) {
    throw new Exception("Connection failed: " . $conn->connect_error);
}

$email = $_GET["email"];
$psw = $_GET["pass"];
$nome = $_GET["nome"];
$cognome = $_GET["cognome"];
$carta_credito = $_GET["carta_credito"];


$via = $_GET["via"];
$citta = $_GET["citta"];
$lat = $_GET["lat"];
$lon = $_GET["lon"];


$idIndirizzo;
$sql = "SELECT * FROM indirizzo WHERE via = ? AND citta = ?";
$stmt = $conn->prepare($sql);

//metto i parametri
$stmt->bind_param("ss", $via, $citta);
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
session_start();
$id = $_SESSION["ID"];

if ($psw == "" || $psw == " ") {
    $sql = "UPDATE `cliente` SET `nome`=?,`cognome`=?,`email`=?,`carta_credito`=?,`IDindirizzo`=? WHERE ID=$id";
    $stmt = $conn->prepare($sql);

    //metto i parametri
    $stmt->bind_param("ssssi", $nome, $cognome, $email, $carta_credito, $idIndirizzo);
  
} else {
    $sql = "UPDATE `cliente` SET `nome`=?,`cognome`=?,`email`=?,`password`=?,`carta_credito`=?,`IDindirizzo`=? WHERE ID=$id";
    $stmt = $conn->prepare($sql);

    //metto i parametri
    $stmt->bind_param("sssssi", $nome, $cognome, $email, $psw, $carta_credito, $idIndirizzo);
}



if ($stmt->execute()) {
    //salvo la variabile username in sessione

    $arr = array("status" => "ok", "message" => "dati aggiornati correttamente");
    echo json_encode($arr);

} else {
    $arr = array("status" => "ko", "message" => "errore nella registrazione");
    echo json_encode($arr);
}

