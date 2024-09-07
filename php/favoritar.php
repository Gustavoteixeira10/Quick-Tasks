<?php
include("conexao.php");


if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['id']) && isset($_SESSION['id'])) {
    $id_usuario = $_SESSION['id'];
}

$id_servico = $_POST['id_servico'];



$sql = "SELECT * FROM `favoritos` WHERE id_usuario = :id_usuario AND id_servico = :id_servico;";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
$stmt->bindParam(':id_servico', $id_servico, PDO::PARAM_INT);
$stmt->execute();

if($stmt->rowCount() == 0) {
    $sql = "INSERT INTO `favoritos` (`id_usuario`, `id_servico`) VALUES (:id_usuario, :id_servico);";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
    $stmt->bindParam(':id_servico', $id_servico, PDO::PARAM_INT);
    $stmt->execute();
} else {
    $sql = "DELETE FROM `favoritos` WHERE id_usuario = :id_usuario AND id_servico = :id_servico;";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
    $stmt->bindParam(':id_servico', $id_servico, PDO::PARAM_INT);
    $stmt->execute();
}
