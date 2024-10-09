<?php
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Quicktasks = new Quicktasks();


if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['id']) && isset($_SESSION['id'])) {
    $id_usuario = $_SESSION['id'];
}

$id_servico = $_POST['id_servico'];


$Quicktasks->favoritar($id_usuario, $id_servico);
