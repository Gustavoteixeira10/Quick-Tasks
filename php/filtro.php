<?php

require('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['id']) && isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
}

$busca = $_POST['busca'];
$categoria = $_POST['categoria'];
$avaliacao = $_POST['avaliacao'];

$sql = "";

$sql = "SELECT * FROM profissional WHERE area LIKE '%$categoria%'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

header("Location: busca.php?busca=$busca&categoria=$categoria");
?>
