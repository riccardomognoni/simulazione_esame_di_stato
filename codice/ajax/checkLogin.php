<?php
header('Content-Type: application/json');
require_once ("../database/credenziali.php");

global $host, $user, $psw, $dbname;


    //connessione al database
    $conn = new mysqli($host, $user, $psw, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    $email = $_GET["email"];
    $psw = $_GET["pass"];
    $user = $_GET["userType"];
    $message="";
    if ($user == "c") {
        // prepare statement
        $sql = "SELECT * FROM cliente WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        
        //metto i parametri
        $stmt->bind_param("ss", $email, $psw);
        $message="cliente";
       
    }else if($user=="a"){
        $sql = "SELECT * FROM admin WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        
        //metto i parametri
        $stmt->bind_param("ss", $email, $psw);
        $message="admin";
    }
    $stmt->execute();


    //controllo se ha trovato qualcosa
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($result->num_rows == 1) {
        //salvo la variabile username in sessione
        session_start();
        $_SESSION["ID"] = $row["ID"];
        $arr = array("status" => "ok", "message" => $message);
        echo json_encode($arr);
    } else {
        $arr = array("status" => "ko", "message" => "Credenziali non valide");
        echo json_encode($arr);
    }

