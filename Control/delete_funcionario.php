<?php
require_once("../Model/funcionario.php");

$funcionario = new Funcionario();
$funcionario->setId($_POST['id']);

if ($funcionario->delete_perfil_funcionario() == true && $funcionario->delete_funcionario() == true){
    $response = 1;
}else{
    $response = 2;
}

header('location: ../View/index.html?response=' . $response);
