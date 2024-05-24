<?php
header('Content-Type: application/json');
require_once ("../database/credenziali.php");

global $host, $user, $psw, $dbname;


//connessione al database
$conn = new mysqli($host, $user, $psw, $dbname);
if ($conn->connect_error) {
    throw new Exception("Connection failed: " . $conn->connect_error);
}

$id = $_GET["IDutente"];
$bloccata = "no";
$tessera= random_int(10000, 99999);






    $sql = "UPDATE `cliente` SET `bloccata`=?,`numero_tessera`=? WHERE ID=$id";
    $stmt = $conn->prepare($sql);

    //metto i parametri
    $stmt->bind_param("si", $bloccata, $tessera);




if ($stmt->execute()) {
    //salvo la variabile username in sessione

    $arr = array("status" => "ok", "message" => "carta rigenerata correttamente");
    echo json_encode($arr);

} else {
    $arr = array("status" => "ko", "message" => "errore");
    echo json_encode($arr);
}

