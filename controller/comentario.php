<?php 
include '../model/Conexao.class.php';
include '../model/Manager.class.php' ;
$Quicktasks = new Quicktasks();


if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['id']) && isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
}

$id_comentador = $_POST['comentador'];
$id_servico = $_POST['id_item'];
$comentario = $_POST['comentario'];

$Quicktasks->insert_comentario($id_comentador, $id_servico, $comentario);





header("Location: ../view/servico.php?servico=$id_servico");


?>