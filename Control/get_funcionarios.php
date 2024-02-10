<?php
require_once("../Model/funcionario.php");

$funcionario = new Funcionario();
$data = $funcionario->get_funcionarios();

// Saída dos dados como JSON
header('Content-Type: application/json');
echo json_encode($data);