<?php
require ('conexao.php');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se os dados foram submetidos via método POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $data_nascimento = $_POST['data'];
        $area = $_POST['area'];
        $localizacao = $_POST['loc'];
        $faixa_preco = $_POST['preco'];

        // Define a consulta SQL
        $sql = "INSERT INTO profissional (nome, email, senha, data_nascimento, area, localizacao, faixa_preco) VALUES (?, ?, ?, ?, ?, ?, ?)";
   
        // Prepara a declaração SQL
        $stmt = $pdo->prepare($sql);

        // Executa a declaração SQL com os parâmetros bind
        $stmt->execute([$nome, $email, $senha, $data_nascimento, $area, $localizacao, $faixa_preco]);

        echo "Novo registro inserido com sucesso.";
    } else {
        echo "Os dados não foram submetidos via método POST.";
    }
} catch (PDOException $e) {
    echo "Erro ao inserir os dados: " . $e->getMessage();
}
?>
