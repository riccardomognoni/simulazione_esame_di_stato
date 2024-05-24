<?php
header('Content-Type: application/json');
require_once ("../database/credenziali.php");

global $host, $user, $psw, $dbname;


//connessione al database
$conn = new mysqli($host, $user, $psw, $dbname);
if ($conn->connect_error) {
    throw new Exception("Connection failed: " . $conn->connect_error);
}

$blocca="si";
session_start();
$id = $_SESSION["ID"];


    $sql = "UPDATE `cliente` SET `bloccata`=? WHERE ID=$id";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $blocca);




if ($stmt->execute()) {
    //salvo la variabile username in sessione

    $arr = array("status" => "ok", "message" => "tessera bloccata");
    echo json_encode($arr);

} else {
    $arr = array("status" => "ko", "message" => "errore ");
    echo json_encode($arr);
}

