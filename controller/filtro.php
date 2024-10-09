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

$busca = $_POST['busca'];
$categoria = $_POST['categoria'];
$avaliacao = $_POST['avaliacao'];

$sql = "";

$sql = "SELECT * FROM profissional WHERE area LIKE '%$categoria%'";


$stmt = $Quicktasks->select_servico_area($busca, $categoria);

$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

header("Location: ../view/busca.php?busca=$busca&categoria=$categoria");
?>