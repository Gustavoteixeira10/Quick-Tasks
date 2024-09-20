<?php 
include("conexao.php");


if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['id']) && isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
}

$sql = "DELETE FROM `perfil` WHERE `perfil`.`id` = $id_user";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$_SESSION['id'] = "";

header("Location: index.php");


?>
