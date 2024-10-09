<?php
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Quicktasks = new Quicktasks();

if (!isset($_SESSION)) {
    session_start();
}

try {

    // Verifica se os dados foram submetidos via método POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Obtém os dados do formulário
        $id_perfil = $_POST['id_perfil'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $data_nascimento = $_POST['data'];
        $area = $_POST['area'];
        $localizacao = $_POST['loc'];
        $faixa_preco = $_POST['preco'];
        

        if ((isset($_FILES["fotos"]) && !empty($_FILES["fotos"]["name"]))) {
            $aquivo_img = preg_replace('/[ -]+/' , '-' , $_FILES["fotos"]["name"]);
            $imagem = "resources/fotos_servicos/" . $aquivo_img;
            move_uploaded_file($_FILES["fotos"]["tmp_name"], "../".$imagem);
        } else {
            $imagem = NULL;
        }
        
        $Quicktasks->insert_profissional($id_perfil, $nome, $email, $senha, $data_nascimento, $area, $localizacao, $faixa_preco, $imagem);

        echo "Novo registro inserido com sucesso.";
        header("Location: ../index.php");
    } else {
        echo "Os dados não foram submetidos via método POST.";
    }
} catch (PDOException $e) {
    echo "Erro ao inserir os dados: " . $e->getMessage();
}
