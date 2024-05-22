<?php
header('Content-Type: application/json');
require_once ("../database/credenziali.php");

global $host, $user, $psw, $dbname;


    //connessione al database
    $conn = new mysqli($host, $user, $psw, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    $stazione = $_GET["stazione"];
   
        $sql =" DELETE FROM `stazione` WHERE ID=?";
        $stmt = $conn->prepare($sql);
        
        //metto i parametri
        $stmt->bind_param("i", $stazione);
       


    //controllo se ha trovato qualcosa

    if (  $stmt->execute()) {
        //salvo la variabile username in sessione
      
        $arr = array("status" => "ok", "message" => "stazione eliminata con successo");
        echo json_encode($arr);
    } else {
        $arr = array("status" => "ko", "message" => "errore nell'eliminazione");
        echo json_encode($arr);
    }

