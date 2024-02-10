<?php
require_once("../Model/funcionario.php");

$funcionario = new Funcionario();
$funcionario->setId($_POST['id']);
$funcionario->setNome($_POST['nome']);
$funcionario->setCargo($_POST['cargo']);
$funcionario->setSalario($_POST['salario']);
$funcionario->setIdade($_POST['idade']);
$funcionario->setEndereco($_POST['endereco']);
$funcionario->setTelefone($_POST['telefone']);

if($funcionario->update_funcionario() == true && $funcionario->update_perfil_funcionario()){
    $response = 5;
}else{
    $response = 6;
}

// Resposta para a inserção do usuário, sucedida ou falha
header('location: ../View/index.html?response='. $response);