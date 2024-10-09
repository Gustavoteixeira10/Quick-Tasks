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

$Quicktasks->delete_perfil($id_user);
$_SESSION['id'] = "";

header("Location: ../index.php");


?>