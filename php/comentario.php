<?php 
include("conexao.php");


if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['id']) && isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
}


$id_item = $_POST['id_item'];
$comentario = $_POST['comentario'];

$sql = "INSERT INTO comentarios VALUES(
    NULL,
    '$id_item',
    '$comentario')";

$stmt = $pdo->prepare($sql);
$stmt->execute();


header("Location: servico.php?servico=$id_item");


?>
