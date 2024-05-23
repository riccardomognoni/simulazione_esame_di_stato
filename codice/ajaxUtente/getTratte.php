<?php
header('Content-Type: application/json');
require_once ("../database/credenziali.php");

global $host, $user, $psw, $dbname;


    //connessione al database
    $conn = new mysqli($host, $user, $psw, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    
   
        $sql = "SELECT tariffa, distanza_percorsa FROM operazione WHERE IDcliente=? and tipo='riconsegna'";
         
        $stmt = $conn->prepare($sql);
        session_start();
        $id=$_SESSION["ID"];
    $stmt->bind_param("i", $id);
    
    $stmt->execute();

    $message="";

    //controllo se ha trovato qualcosa
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        //salvo la variabile username in sessione
      $message.=$row["tariffa"].",".$row["distanza_percorsa"].";";
    }  
        $arr = array("status" => "ok", "message" => $message);
        echo json_encode($arr);
 
