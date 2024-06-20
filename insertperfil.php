<?php
require ('conexao.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se os dados foram enviados via método POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Prepara os dados recebidos do formulário
       
        $email = $_POST['email']; 
        $telefone = $_POST['telefone'];
        $nome = $_POST['nome'];
        $data_nascimento = $_POST['data_nascimento'];
      
        // No entanto, a data precisa ser convertida para o formato MySQL antes de ser inserida no banco de dados
        $data_nascimento = date('Y-m-d', strtotime($_POST["data"]));

        // Prepara a instrução SQL para inserção
        $sql = "INSERT INTO perfil ( email, telefone,nome, data_nascimento) VALUES (?, ?, ?, ?)";

        // Prepara a declaração SQL
        $stmt = $pdo->prepare($sql);

        // Executa a declaração SQL com os parâmetros bind
        $stmt->execute([ $email, $telefone, $nome, $data_nascimento]);

        echo "Novo registro inserido com sucesso.";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

