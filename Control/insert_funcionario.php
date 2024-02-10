<?php
require_once("../Model/funcionario.php");

$funcionario = new Funcionario();
$funcionario->setNome($_POST['nome']);
$funcionario->setCargo($_POST['cargo']);
$funcionario->setSalario($_POST['salario']);
$funcionario->setIdade($_POST['idade']);
$funcionario->setEndereco($_POST['endereco']);
$funcionario->setTelefone($_POST['telefone']);

if($funcionario->insert_funcionario_completo() == true){
    $response = 3;
}else{
    $response = 4;
}
    
// Resposta para a inserção do usuário, sucedida ou falha
header('location: ../View/Index.html?response='. $response);