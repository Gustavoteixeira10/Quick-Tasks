<?php
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Quicktasks = new Quicktasks();

if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
}



// Obter os valores do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];


$resultado = $Quicktasks->login($email, $senha);

$user = $resultado->fetch(PDO::FETCH_ASSOC);
$_SESSION['id'] = $user['id'];

$numRows = $resultado->rowCount();
echo $numRows;



if ($numRows > 0) {
    // Login bem-sucedido
    echo "Login bem-sucedido! Bem vindo";
    header("Location: ../index.php");
} else {
    echo "Email ou senha incorretos!";
}
