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
$numero_tessera = random_int(10000, 99999);


$via = $_GET["via"];
$citta = $_GET["citta"];
$cap = $_GET["cap"];
$provincia = $_GET["provincia"];
$regione = $_GET["regione"];

$idIndirizzo;
$sql = "SELECT * FROM indirizzo WHERE via = ? AND cap = ?";
$stmt = $conn->prepare($sql);

//metto i parametri
$stmt->bind_param("si", $via, $cap);
$stmt->execute();


//controllo se ha trovato qualcosa
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if ($result->num_rows == 1) {
    $idIndirizzo = $row["ID"];
} else {
    $sql = "INSERT INTO `indirizzo`(`via`, `citta`, `CAP`, `provincia`, `regione`) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);

    //metto i parametri
    $stmt->bind_param("ssiss", $via, $citta, $cap, $provincia, $regione);
    $stmt->execute();
    $idIndirizzo = mysqli_insert_id($conn);
}

$sql = "INSERT INTO `cliente`(`nome`, `cognome`, `email`, `password`, `numero_tessera`,`carta_credito`, `IDindirizzo`) VALUES (?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);

//metto i parametri
$stmt->bind_param("ssssisi", $nome, $cognome, $email, $psw, $numero_tessera, $carta_credito, $idIndirizzo);



if ($stmt->execute()) {
    //salvo la variabile username in sessione

    $arr = array("status" => "ok", "message" => "utente registrato correttamente");
    echo json_encode($arr);

}else {
    $arr = array("status" => "ko", "message" => "errore nella registrazione");
    echo json_encode($arr);
}

