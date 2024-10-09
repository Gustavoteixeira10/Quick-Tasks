<?php
class Quicktasks extends Conexao
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::pdo();
    }

    public function select_perfil($_id_user)
    {

        $sql = "SELECT * FROM perfil WHERE id = $_id_user";

        $stmt = $this->pdo->prepare($sql);

        // Executa a consulta
        $stmt->execute();

        return $stmt;
    }
    public function select_servico($_id_user)
    {
        $sql = "SELECT * FROM profissional WHERE id_perfil = $_id_user";

        $stmt = $this->pdo->prepare($sql);

        // Executa a consulta
        $stmt->execute();

        return $stmt;
    }
    public function insert_cadastro($_nome, $_email, $_senha, $_data_nascimento, $_foto_perfil)
    {
        $sql = "SELECT email FROM perfil WHERE email = '$_email'";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $resultado = $stmt->fetchAll();

        if (!$resultado) {
            $sql = "INSERT INTO perfil (nome, email, senha, data_nascimento, foto_perfil) VALUES (?, ?, ?, ?, ?)";
            // Prepara a declaração SQL
            $stmt = $this->pdo->prepare($sql);

            // Executa a declaração SQL com os parâmetros bind
            $stmt->execute([$_nome, $_email, $_senha, $_data_nascimento, $_foto_perfil]);
            echo "Novo registro inserido com sucesso.";
            header("Location: ../index.php");
        } else {

            echo ("<script>
                    window.alert('Ocorreu um erro. Usuário já existe')
                    window.location.href='../view/cadastrese.php';
                    </script>");
        }
    }

    public function login($_email, $_senha)
    {

        $sql = "SELECT * FROM perfil WHERE email = :email AND senha = :senha";
        $stmt = $this->pdo->prepare($sql);

        // Vincula os parâmetros de forma segura
        $stmt->bindParam(':email', $_email);
        $stmt->bindParam(':senha', $_senha);

        // Executa a consulta
        $stmt->execute();


        return $stmt;
    }

    public function insert_profissional($_id_perfil, $_nome, $_email, $_senha, $_data_nascimento, $_area, $_localizacao, $_faixa_preco, $_imagem)
    {
        // Define a consulta SQL
        $sql = "INSERT INTO profissional (id_perfil, nome, email, senha, data_nascimento, area, localizacao, faixa_preco, fotos) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepara a declaração SQL
        $stmt = $this->pdo->prepare($sql);

        // Executa a declaração SQL com os parâmetros bind
        $stmt->execute([$_id_perfil, $_nome, $_email, $_senha, $_data_nascimento, $_area, $_localizacao, $_faixa_preco, $_imagem]);
    }

    public function update_perfil($_nome, $_email, $_telefone, $_imagem, $_id_usuario)
    {

        $sql = "UPDATE `perfil` SET `nome` = '$_nome', `email` = '$_email', `telefone` = '$_telefone', `foto_perfil` = '$_imagem' WHERE `perfil`.`id` = '$_id_usuario';";


        $stmt = $this->pdo->prepare($sql);


        $stmt->execute();
    }

    public function delete_perfil($_id_user)
    {
        $sql = "DELETE FROM `perfil` WHERE `perfil`.`id` = $_id_user";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function infos_produto($_id_produto)
    {
        // Média de nota, avaliações

        $stmt = $this->pdo->query("SELECT FLOOR(AVG(qnt_estrela)) AS media_inteira FROM avaliacoes WHERE id_servico = $_id_produto");
        $media_nota = $stmt->fetch();

        $stmt = $this->pdo->query("SELECT COUNT(*) AS total_registros FROM avaliacoes WHERE id_servico = $_id_produto");
        $avaliacoes = $stmt->fetch();


        return array($media_nota, $avaliacoes);
    }

    public function select_favoritos($_id_servico)
    {
        $sql = ("SELECT * FROM `favoritos` WHERE id_servico = $_id_servico");
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $favoritos = $stmt->fetch();
        return $favoritos;
    }

    public function select_pagina_favoritos($_id_usuario)
    {
        $sql = "SELECT * FROM favoritos WHERE id_usuario = :id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $_id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    public function select_favoritos_busca($_id_user, $_id_servico)
    {
        $sql = "SELECT * FROM `favoritos` WHERE id_usuario = $_id_user AND id_servico = $_id_servico";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $favoritos = $stmt->fetch();
        return $favoritos;
    }

    public function select_servico_favoritos($_resultado)
    {
        $sql = "SELECT * FROM profissional WHERE id IN (";

        if ($_resultado != 0) {
            foreach ($_resultado as $row) {

                $sql .= "$row[id_servico],";
            }
            $sql .= "0);";
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    public function busca_servico($_busca, $_ordem)
    {
        if ($_ordem == 'nome') {
            $sql = "SELECT * FROM profissional WHERE nome LIKE '%$_busca%' ORDER BY `nome` ASC";
        } else if ($_ordem == 'avaliacao') {

            $sql = "SELECT id_servico
                FROM avaliacoes
                GROUP BY id_servico
                ORDER BY AVG(qnt_estrela) DESC";

            // Preparar e executar a consulta
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            // Recuperar os IDs ordenados
            $ids_ordenados = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);




            $ids_ordenados_str = implode(',', $ids_ordenados);

            $sql = "SELECT * FROM profissional
                WHERE id IN ($ids_ordenados_str)
                ORDER BY FIELD(id, $ids_ordenados_str)";

            // Preparar e executar a consulta


            // Buscar e exibir os resultados
            $outra_tabela_dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else if ($_ordem == 'novidade') {
            $sql = "SELECT * FROM profissional WHERE nome LIKE '%$_busca%' ORDER BY `id` DESC";
        } else {
            $sql = "SELECT * FROM profissional WHERE nome LIKE '%$_busca%' ORDER BY `nome` ASC";
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    public function select_servico_area($_busca, $_categoria)
    {
        $sql = "SELECT * FROM `profissional` WHERE `nome` LIKE '%$_busca%' AND `area` LIKE '%$_categoria%'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    public function favoritar($_id_usuario, $_id_servico)
    {
        $sql = "SELECT * FROM `favoritos` WHERE id_usuario = :id_usuario AND id_servico = :id_servico;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $_id_usuario, PDO::PARAM_STR);
        $stmt->bindParam(':id_servico', $_id_servico, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            $sql = "INSERT INTO `favoritos` (`id_usuario`, `id_servico`) VALUES (:id_usuario, :id_servico);";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_usuario', $_id_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':id_servico', $_id_servico, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $sql = "DELETE FROM `favoritos` WHERE id_usuario = :id_usuario AND id_servico = :id_servico;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id_usuario', $_id_usuario, PDO::PARAM_STR);
            $stmt->bindParam(':id_servico', $_id_servico, PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function select_servico_id($_id_servico)
    {
        $sql = "SELECT * FROM profissional WHERE id = :id_servico";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_servico', $_id_servico, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    public function select_avaliacoes($_id_usuario, $_id_servico)
    {
        $sql = "SELECT * FROM avaliacoes WHERE id_user = :id_usuario AND id_servico = :id_servico";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $_id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_servico', $_id_servico, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }
    public function insert_avaliacoes($_id_usuario, $_id_servico, $_nota, $_notaQnt)
    {
        if ($_notaQnt == 0) {
            $sql = "INSERT INTO avaliacoes(id_user, id_servico, qnt_estrela) VALUES (?, ?, ?)";

            // Prepara a declaração SQL
            $stmt = $this->pdo->prepare($sql);

            // Executa a declaração SQL com os parâmetros bind
            $stmt->execute([$_id_usuario, $_id_servico, $_nota]);
        } else {
            $sql = "UPDATE avaliacoes SET qnt_estrela = ? WHERE id_user = ? AND id_servico = ?";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([$_nota, $_id_usuario, $_id_servico]);
        }
    }

    public function select_comentario($_id_servico)
    {
        $sql = "SELECT * FROM comentarios WHERE secao = :id_servico";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_servico', $_id_servico, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    public function insert_comentario($_id_comentador, $_id_servico, $_comentario)
    {
        $sql = "INSERT INTO comentarios VALUES(
            NULL,
            :id_comentador,
            :id_servico,
            :comentario)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_comentador', $_id_comentador, PDO::PARAM_INT);
        $stmt->bindParam(':id_servico', $_id_servico, PDO::PARAM_INT);
        $stmt->bindParam(':comentario', $_comentario, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete_comentario($_id_comentario)
    {
        //MELHORAR SEGURANÇA DO DELETE COMENTARIO
        $sql = "DELETE FROM `comentarios` WHERE `comentarios`.`id` = :id_comentario";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_comentario', $_id_comentario, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function update_comentario($_novo_comentario, $_id_comentario)
    {
        $sql = "UPDATE `comentarios` SET `comentario` = :novo_comentario WHERE `comentarios`.`id` = :id_comentario;";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':novo_comentario', $_novo_comentario, PDO::PARAM_STR);
        $stmt->bindParam(':id_comentario', $_id_comentario, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function select_contratado($_id_usuario){
        $sql = "SELECT * FROM `contratados` WHERE id_cliente = :id_usuario";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $_id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    public function insert_contratado($_servico, $_cliente)
    {
        $sql = "INSERT INTO `contratados`(`id`, `id_servico`, `id_cliente`) VALUES (NULL, :servico, :cliente)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':servico', $_servico, PDO::PARAM_INT);
        $stmt->bindParam(':cliente', $_cliente, PDO::PARAM_INT);
        $stmt->execute();
    }
}
