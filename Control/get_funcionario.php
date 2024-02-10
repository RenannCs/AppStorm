<?php
require_once("../Model/funcionario.php");

if(isset($_POST['id'])){

    $funcionario = new Funcionario();
    $funcionario->setId($_POST['id']);
    $data = $funcionario->get_funcionario();


    // Saída dos dados como JSON
    header('Content-Type: application/json');
    echo json_encode($data);

} else {
    echo "ID não encontrado!";
}
?>
