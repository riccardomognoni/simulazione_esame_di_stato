<?php
header('Content-Type: application/json');
require_once ("../database/credenziali.php");

global $host, $user, $psw, $dbname;


    //connessione al database
    $conn = new mysqli($host, $user, $psw, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    
   
        $sql = "SELECT ID,nome,cognome,numero_tessera FROM cliente WHERE bloccata='si'";
        $stmt = $conn->prepare($sql);
    
        //metto i parametri
   
    
    $stmt->execute();
    $message="";

    //controllo se ha trovato qualcosa
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc())  {
        //salvo la variabile username in sessione
      $message.=$row["ID"].",".$row["nome"].",".$row["cognome"].",".$row["numero_tessera"].";";
    }  
        $arr = array("status" => "ok", "message" => $message);
        echo json_encode($arr);
 
