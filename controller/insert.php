<?php
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Quicktasks = new Quicktasks();

try {

    // Verifica se os dados foram enviados via método POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepara os dados recebidos do formulário
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $foto_perfil = NULL;
        $data_nascimento = date('Y-m-d', strtotime($_POST["data"]));

        
        $Quicktasks->insert_cadastro($nome, $email, $senha, $data_nascimento, $foto_perfil);
       
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>


