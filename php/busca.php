<?php

require('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['id']) && isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
}


$busca = $_GET['busca'];
if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
}



//$sql2 = "SELECT * FROM `profissional` WHERE `area` LIKE '$categoria' AND `faixa_preco` LIKE 'R$$faixa_preco1-R$$faixa_preco2'";
$sql = "SELECT * FROM profissional WHERE nome LIKE '%$busca%' ORDER BY `nome` ASC";


$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
$numResultados = $stmt->rowCount();




if (isset($_GET['categoria'])) {
    $sql = "SELECT * FROM `profissional` WHERE `nome` LIKE '%$busca%' AND `area` LIKE '%$categoria%'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
}






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
</head>
</head>

<body>

    <header>
        <h1><a href="index.php">QuickTasks</a></h1>
    </header>




    <!-- Sidebar -->
    <div id="mySidebar" class="sidebar">
        <h1 class="title-filtro">Filtrar</h1>

        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <form method="POST" action="filtro.php" class="botaoC">
            <input type="text" name="busca" value="<?php echo $busca ?>" hidden>
            <a class="collapseButton" data-target="collapseContent1">Categoria</a>
            <div id="collapseContent1" class="collapse">

                <div class="mb-3">
                    <input type="text" class="form-control" name="categoria" value="<?php
                                                                                    if (isset($_GET['categoria'])) {
                                                                                        echo $categoria;
                                                                                    }
                                                                                    ?>">
                </div>


            </div>

            <a class="collapseButton" data-target="collapseContent2">Preço</a>
            <div id="collapseContent2" class="collapse">


                <input type="text" class="form-control" name="faixa_preco1" disabled>
                -
                <input type="text" class="form-control" name="faixa_preco2" disabled>
            </div>



            <a class="collapseButton" data-target="collapseContent3">Gênero</a>
            <div id="collapseContent3" class="collapse">

                <div class="mb-3">
                    <input type="text" class="form-control" disabled>
                </div>

            </div>

            <a class="collapseButton" data-target="collapseContent4">Avaliações</a>
            <div id="collapseContent4" class="collapse">

                <div class="mb-3">
                    <input type="text" class="form-control" name="avaliacao" placeholder="1-5" disabled>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>

    </div>

    <div id="main">
        <button class="openbtn" onclick="openNav()">☰</button>
    </div>



    <!-- CONTEUDO -->
    <main id="conteudo">
        <?php

        if ($stmt->rowCount() != 0) {
            foreach ($resultado as $row) { 
                $busca2 = $row['id'];
                $stmt = $pdo->query("SELECT FLOOR(AVG(qnt_estrela)) AS media_inteira FROM avaliacoes WHERE id_servico = $busca2");
                $media_nota = $stmt->fetch();

                $stmt = $pdo->query("SELECT COUNT(*) AS total_registros FROM avaliacoes WHERE id_servico = $busca2");
                $avaliacoes = $stmt->fetch();
                ?>


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
        <?php

            }
        } else {
            ?> <p class="erro">Nenhum serviço encontrado para a área pesquisada.</p> <?php
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
    const estrelas = document.getElementsByClassName("star")

    var media_notas = String(<?php echo $media_nota['media_inteira']; ?>);
    console.log(media_notas)


    switch (media_notas) {
        default:
            break;

        case "1":
            estrelas[4].classList.add("nota")
            break;

        case "2":
            estrelas[3].classList.add("nota")
            break;

        case "3":
            estrelas[2].classList.add("nota")
            break;

        case "4":
            estrelas[1].classList.add("nota")
            break;

        case "5":
            estrelas[0].classList.add("nota")
            break;
        }









            function openNav() {
                document.getElementById("mySidebar").style.width = "250px";
                document.getElementById("main").style.transform = "translateX(-250px)";
            }

            function closeNav() {
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("main").style.transform = "";
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
