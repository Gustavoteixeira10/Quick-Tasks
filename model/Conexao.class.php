<?php
class Conexao {
    
    private $host = 'localhost';
    private $db_name = 'quicktasks';
    private $username = 'root';       
    private $password = '';           
    private $pdo;

    public function pdo() {
        $this->pdo = null;

        try {
            // Criando a conexão com PDO
            $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            // Exibindo mensagem de erro
            echo "Erro de conexão: " . $e->getMessage();
        }
        catch (Exception $e){
            echo "Erro genérico: " . $e->getMessage();
        }

        // Retornando a conexão
        return $this->pdo;
    }
}
