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
    $nome=$_GET["nome"];
    $slot=$_GET["slot"];


    if($nome=="" || $nome==" "){
        $sql = "UPDATE `stazione` SET `numero_slot`=? WHERE ID=$stazione";
        $stmt = $conn->prepare($sql);

//metto i parametri
        $stmt->bind_param("i", $slot);


    }else if($slot=="" || $slot==" "){
        $sql = "UPDATE `stazione` SET `nome`=? WHERE ID=$stazione";
        $stmt = $conn->prepare($sql);

//metto i parametri
        $stmt->bind_param("s", $nome);
    }else{
        $sql = "UPDATE `stazione` SET `nome`=? ,`numero_slot`=? WHERE ID=$stazione";
        $stmt = $conn->prepare($sql);

//metto i parametri
        $stmt->bind_param("si", $nome,$slot);
    }

    if($stmt->execute()){
        $arr = array("status" => "ok", "message" => "stazione aggiornata");
        echo json_encode($arr);
    } else {
        $arr = array("status" => "ko", "message" => "errore");
        echo json_encode($arr);
    }

    
    
    

