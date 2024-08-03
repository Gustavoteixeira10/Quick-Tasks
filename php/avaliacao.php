<?php 
require('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['id']) && isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
}


$id_servico = $_POST['id_pag'];



$nota = $_POST['nota'];
$notaQnt = $_POST['nota_qnt'];

if($notaQnt == 0) {
    $sql = "INSERT INTO avaliacoes(id_user, id_servico, qnt_estrela) VALUES (?, ?, ?)";
   
// Prepara a declaração SQL
$stmt = $pdo->prepare($sql);

// Executa a declaração SQL com os parâmetros bind
$stmt->execute([$id_user, $id_servico, $nota]);

} else {
    $sql = "UPDATE avaliacoes SET qnt_estrela = ? WHERE id_user = ? AND id_servico = ?";
   
    $stmt = $pdo->prepare($sql);

    $stmt->execute([$nota, $id_user, $id_servico]);
}

