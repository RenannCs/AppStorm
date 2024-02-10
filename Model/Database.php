<?php

//Função responsável por criar uma conexão com o banco de dados
function createConnection(){

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "AppStorm";
    $porta = "3306";
    
    $conn = new mysqli($host, $user, $password, $database, $porta);
    
    
    if ($conn->connect_error){
        die("Conexão falhou:" . $conn->connect_error);
    }
    
    return $conn;
}
