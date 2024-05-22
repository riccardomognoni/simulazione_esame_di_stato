<?php
header('Content-Type: application/json');
require_once ("../database/credenziali.php");

global $host, $user, $psw, $dbname;


    //connessione al database
    $conn = new mysqli($host, $user, $psw, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    
   
        $sql = "SELECT cliente.nome,cliente.cognome,cliente.email,cliente.carta_credito, indirizzo.via, indirizzo.citta
        FROM cliente
        JOIN indirizzo on indirizzo.ID=cliente.IDindirizzo
        WHERE cliente.ID=?";
        $stmt = $conn->prepare($sql);

        //metto i parametri
    session_start();
        $id=$_SESSION["ID"];
    $stmt->bind_param("i", $id);
    
    $stmt->execute();
    $message="";

    //controllo se ha trovato qualcosa
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($result->num_rows == 1)  {
        //salvo la variabile username in sessione
      $message.=$row["nome"].";".$row["cognome"].";".$row["email"].";".$row["carta_credito"].";".$row["via"].";".$row["citta"];
    }  
        $arr = array("status" => "ok", "message" => $message);
        echo json_encode($arr);
 
