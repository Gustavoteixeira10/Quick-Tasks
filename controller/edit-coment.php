<?php
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Quicktasks = new Quicktasks();

if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['id']) && isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
}

$id_comentario = $_POST['id_comentario'];
$id_item = $_POST['id_item'];
$novo_comentario = $_POST['novo_comentario'];

$Quicktasks->update_comentario($novo_comentario, $id_comentario);


header("Location: ../view/servico.php?servico=$id_servico");





?>
