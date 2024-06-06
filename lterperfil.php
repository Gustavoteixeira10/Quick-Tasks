<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quicktasks";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if (!isset($_SESSION)) {
    session_start();
}
require('conexao.php');

$id_usuario = $_SESSION['id'];

$sql = "SELECT * FROM perfil WHERE id = $id_usuario";
// Prepara a declaração SQL
$stmt = $pdo->prepare($sql);

// Executa a declaração SQL com os parâmetros bind
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);


$nome = $_POST['nome'];
$email = $_POST['email'];
$data = $_POST['data'];
$telefone = $_POST['telefone'];
$imagem = $usuario['foto_perfil'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if ((isset($_FILES["foto"]) && !empty($_FILES["foto"]["name"]))) {
        $imagem = "./foto_usuario/" . $_FILES["foto"]["name"];
        move_uploaded_file($_FILES["foto"]["tmp_name"], $imagem);
    }


    // Prepara os dados recebidos do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    // No entanto, a data precisa ser convertida para o formato MySQL antes de ser inserida no banco de dados
    $data_nascimento = date('Y-m-d', strtotime($_POST["data"]));

    // Prepara a instrução SQL para inserção
    $sql = "UPDATE `perfil` SET `nome` = '$nome', `email` = '$email', `telefone` = '$telefone', `foto_perfil` = '$imagem' WHERE `perfil`.`id` = '$id_usuario';";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Executa a declaração SQL com os parâmetros bind
    $stmt->execute();


    echo "Dados alterados com sucesso!";
    //header("Location: perfil.php");
}
