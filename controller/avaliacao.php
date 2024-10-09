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


$id_servico = $_POST['id_pag'];

$nota = $_POST['nota'];
$notaQnt = $_POST['nota_qnt'];

$Quicktasks->insert_avaliacoes($id_user, $id_servico, $nota, $notaQnt);


header("Location: ../view/servico.php?servico=$id_servico");