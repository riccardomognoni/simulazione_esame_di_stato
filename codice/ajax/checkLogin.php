<?php
header('Content-Type: application/json');
require_once("../database/credenziali.php");

global $host, $user, $psw, $dbname;

try{
    //connessione al database
    $conn = new mysqli($host, $user, $psw, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    $email = $_GET["user"];
    $psw = $_GET["pass"];

    // prepare statement
    $sql = "SELECT * FROM cliente WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Errore nella preparazione della query: " . $conn->error);
    }
    //metto i parametri
    $stmt->bind_param("ss", $email, $psw);
    if (!$stmt->execute()) {
        throw new Exception("Errore durante l'esecuzione della query: " . $stmt->error);
    }

    //controllo se ha trovato qualcosa
    $result = $stmt->get_result();
    $row=$result->fetch_assoc();
    if ($result->num_rows == 1) {
        //salvo la variabile username in sessione
        session_start();
        $_SESSION["IDuser"] = $row["ID"];  
        $arr = array("status" => "ok", "message" => "accesso effettuato");
        echo json_encode($arr);
    } else {
        $arr = array("status" => "ko", "message" => "Credenziali non valide");
        echo json_encode($arr);
    }

} catch (Exception $e) {
    $arr = array("status" => "ko", "message" => $e->getMessage());
    echo json_encode($arr);
}