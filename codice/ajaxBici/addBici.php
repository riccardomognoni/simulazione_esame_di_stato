<?php
header('Content-Type: application/json');
require_once ("../database/credenziali.php");

global $host, $user, $psw, $dbname;


//connessione al database
$conn = new mysqli($host, $user, $psw, $dbname);
if ($conn->connect_error) {
    throw new Exception("Connection failed: " . $conn->connect_error);
}

$gps = $_GET["gps"];
$rfid=$_GET["rfid"];



$km=0;

$attiva=true;

$sql = "INSERT INTO `bicicletta`(`KMtotali`, `gps`, `RFID`, `attiva`)  VALUES (?,?,?,?)";
$stmt = $conn->prepare($sql);

//metto i parametri
$stmt->bind_param("dssb", $km,$gps, $rfid,$attiva);



if ($stmt->execute()) {
    //salvo la variabile username in sessione
    $idBici = mysqli_insert_id($conn);
    $arr = array("status" => "ok", "message" => $idBici);
    echo json_encode($arr);

}else {
    $arr = array("status" => "ko", "message" => "errore");
    echo json_encode($arr);
}

