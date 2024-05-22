<?php
header('Content-Type: application/json');
require_once ("../database/credenziali.php");

global $host, $user, $psw, $dbname;


    //connessione al database
    $conn = new mysqli($host, $user, $psw, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    
   
        $sql = "SELECT indirizzo.latitudine, indirizzo.longitudine FROM indirizzo
        JOIN stazione ON stazione.IDindirizzo=indirizzo.ID;";
        $stmt = $conn->prepare($sql);
        
        //metto i parametr
    
    $stmt->execute();

    $message="";

    //controllo se ha trovato qualcosa
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        //salvo la variabile username in sessione
      $message.=$row["latitudine"].",".$row["longitudine"].";";
    }  
        $arr = array("status" => "ok", "message" => $message);
        echo json_encode($arr);
 
