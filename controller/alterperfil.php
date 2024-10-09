<?php
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Quicktasks = new Quicktasks();

if (!isset($_SESSION)) {
    session_start();
}


$id_usuario = $_SESSION['id'];

$stmt = $Quicktasks->select_perfil($id_usuario);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);


$nome = $_POST['nome'];
$email = $_POST['email'];
$data = $_POST['data'];
$telefone = $_POST['telefone'];
$imagem = $usuario['foto_perfil'];



if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if ((isset($_FILES["foto"]) && !empty($_FILES["foto"]["name"]))) {
        $imagem = "resources/foto_usuario/" . $_FILES["foto"]["name"];
        move_uploaded_file($_FILES["foto"]["tmp_name"], "../".$imagem);
    }


    // Prepara os dados recebidos do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    $Quicktasks->update_perfil($nome, $email, $telefone, $imagem, $id_usuario);


    echo "Dados alterados com sucesso!";
    header("Location: ../view/perfil.php");
}
