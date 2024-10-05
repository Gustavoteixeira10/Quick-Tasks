<?php

require('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['id']) && isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
}


$sql = "SELECT * FROM `profissional` WHERE id_perfil = $id_user";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
$numResultados = $stmt->rowCount();



?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/busca.css">
    <title>Busca</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://example.com/fontawesome/vVERSION/js/all.js" data-auto-a11y="true"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
</head>

<body onscroll="scroll()">

    <header>
        <h1><a href="index.php">QuickTasks</a></h1>
    </header>






<!-- CONTEUDO -->
<main id="conteudo" style="margin-top: 15px;">
        <?php

        if ($stmt->rowCount() != 0) {
            foreach ($resultado as $row) {
                $busca2 = $row['id'];
                $stmt = $pdo->query("SELECT FLOOR(AVG(qnt_estrela)) AS media_inteira FROM avaliacoes WHERE id_servico = $busca2");
                $media_nota = $stmt->fetch();

                $stmt = $pdo->query("SELECT COUNT(*) AS total_registros FROM avaliacoes WHERE id_servico = $busca2");
                $avaliacoes = $stmt->fetch();

                $stmt = $pdo->query("SELECT * FROM `favoritos` WHERE id_servico = $row[id]");
                $favoritos = $stmt->fetch();

                

                
        ?>



                <div class="main-card">
                     <!-- <div class="favoritar">
                        <button onclick="favoritar(this, <?= $row['id'] ?>)">
                            <svg class="<?php if($favoritos){echo "favoritado";} ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                            </svg>
                        </button>
                    </div> -->

                    <a class="card" href="servico.php?servico=<?php echo $row['id'] ?>">
                        <div class="img-servico"></div>

                        <h3 class="nome"><?php echo $row['nome'] ?></h3>
                        <span class="avaliacoes">
                            <span>(<?php echo $avaliacoes['total_registros'] ?>)</span>
                            <svg class="star <?php echo $media_nota['media_inteira'] == 5 ? "nota" : ""; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                            </svg>

                            <svg class="star <?php echo $media_nota['media_inteira'] == 4 ? "nota" : ""; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                            </svg>

                            <svg class="star <?php echo $media_nota['media_inteira'] == 3 ? "nota" : ""; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                            </svg>

                            <svg class="star <?php echo $media_nota['media_inteira'] == 2 ? "nota" : ""; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                            </svg>

                            <svg class="star <?php echo $media_nota['media_inteira'] == 1 ? "nota" : ""; ?>" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                            </svg>
                        </span>

                        <p class="regiao"><?php echo $row['localizacao'] ?></p>

                        <p class="area"><?php echo $row['area'] ?></p>

                        <p class="preco"><?php echo $row['faixa_preco'] ?></p>
                    </a>
                </div>
            <?php

            }
        } else {
            ?> <p class="erro">Você não possui nenhum serviço cadastrado</p> <?php
                                                                                    }
                                                                                        ?>
    </main>



    <!-- Botao dark mode -->

    <div>
        <input type="checkbox" class="checkbox" id="chk" />
        <label class="label" for="chk">
            <i class="fas fa-moon"></i>
            <i class="fas fa-sun"></i>
            <div class="ball"></div>
        </label>
    </div>
    <script defer src="script.js"></script>
    <script src="https://kit.fontawesome.com/998c60ef77.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
<script>

function favoritar(e, id) {
        e.firstElementChild.classList.toggle('favoritado')

        console.log(id)

        //Ajax

        $.ajax({
            url: 'favoritar.php', // Mesma página
            type: 'POST',
            data: {
                id_servico: id,
                ajax: 1
            },
            success: function(response) {
                $(`#${id}`).html(response);
                console.log('sucesso')
            }
        });

    }



    document.querySelectorAll('.collapseButton').forEach(button => {
        button.addEventListener('click', function() {
            var targetId = this.getAttribute('data-target');
            var content = document.getElementById(targetId);
            if (content.classList.contains('show')) {
                content.classList.remove('show');
            } else {
                content.classList.add('show');
            }
        });
    });
</script>

</html>
