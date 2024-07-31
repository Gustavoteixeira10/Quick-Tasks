<?php

// Conectar ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quicktasks";

$conn = new mysqli($servername, $username, $password, $dbname);

//Inicia a session de login do usuário
session_start();

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Obter os valores do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Consulta SQL para verificar se o email e a senha estão corretos
$sql = "SELECT * FROM perfil WHERE email='$email' AND senha='$senha'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['id'] = $user['id'];


if ($result->num_rows > 0) {
    // Login bem-sucedido
    echo "Login bem-sucedido! Bem vindo";
    header("Location: index.php");
} else {
    echo "Email ou senha incorretos!";
}
$conn->close();
