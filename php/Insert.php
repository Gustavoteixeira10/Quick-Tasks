<?php
require ('conexao.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se os dados foram enviados via método POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepara os dados recebidos do formulário
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        // No entanto, a data precisa ser convertida para o formato MySQL antes de ser inserida no banco de dados
        $data_nascimento = date('Y-m-d', strtotime($_POST["data"]));

        // Prepara a instrução SQL para inserção
        $sql = "INSERT INTO perfil (nome, email, senha, data_nascimento, foto_perfil) VALUES (?, ?, ?, ?, ?)";

        // Prepara a declaração SQL
        $stmt = $pdo->prepare($sql);

        // Executa a declaração SQL com os parâmetros bind
        $stmt->execute([$nome, $email, $senha, $data_nascimento, './usuario.jpg']);

        echo "Novo registro inserido com sucesso.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>






