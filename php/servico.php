<?php
include("conexao.php");
$id = $_GET['servico'];
//Criar o comando


if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['id']) && isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
}


$sql = "SELECT * FROM profissional WHERE id = $id";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$item = $stmt->fetch(PDO::FETCH_ASSOC);
$numResultados = $stmt->rowCount();


// Quantidade
$stmt = $pdo->query("SELECT COUNT(*) AS total_registros FROM avaliacoes WHERE id_servico = $id");
$avaliacoes = $stmt->fetch();


// Avaliação usuário
$qnt = 0;
$avaliacao = "";
if (!empty($id_user) || isset($id_user)) {
    $stmt = $pdo->query("SELECT * FROM avaliacoes WHERE id_user = $id_user AND id_servico = $id");
    $avaliacao = $stmt->fetchColumn(3);
    $qnt = $stmt->rowCount();
}


//Média
$stmt = $pdo->query("SELECT FLOOR(AVG(qnt_estrela)) AS media_inteira FROM avaliacoes WHERE id_servico = $id");
$media_nota = $stmt->fetch();



$comentarios = "SELECT comentario FROM comentarios WHERE secao = $id";
$stmt = $pdo->prepare($comentarios);
$stmt->execute();
$comentado = $stmt;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickTasks | Serviço</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="logar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="css/servico.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>

    <header>
        <h1><a href="index.php">QuickTasks</a></h1>

        <div>
            <input type="checkbox" class="checkbox" id="chk" />
            <label class="label" for="chk">
                <i class="fas fa-moon"></i>
                <i class="fas fa-sun"></i>
                <div class="ball"></div>
            </label>
        </div>


        <script src="https://kit.fontawesome.com/998c60ef77.js" crossorigin="anonymous"></script>

    </header>

    <main>
        <section class="text-center">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSu5jQ9gClnE2MsnLWClIfUtYbbAa4DNuwqkA&s" class="rounded" alt="...">
        </section>

        <section>
            <div>
                <h1>
                    <?php echo $item['nome'] ?>
                </h1>
            </div>

            <h3>E-mail: <b> <?php echo $item['email'] ?></b></h3>

            <p>
                <?php echo $item['data_nascimento'] ?>
            </p> <br>

            <span>
                Area: <?php echo $item['area'] ?>
            </span><br>

            <span>
                Localização: <?php echo $item['localizacao'] ?>
            </span><br>

            <span>
                Faixa de preço: <?php echo $item['faixa_preco'] ?>
            </span>


            <form class="avalicoes" action="avaliacao.php" method="post">
                <span>(<?php echo $avaliacoes['total_registros'] ?>) Avaliações</span>


                <input type="text" name="id_pag" value="<?php echo $id ?>" hidden>
                <input type="text" name="nota_qnt" value="<?php echo $qnt ?>" hidden>

                <button class="star" name="nota" type="submit" value="5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                    </svg>
                </button>

                <button class="star" name="nota" type="submit" value="4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                    </svg>
                </button>

                <button class="star" name="nota" type="submit" value="3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                    </svg>
                </button>

                <button class="star" name="nota" type="submit" value="2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                    </svg>
                </button>

                <button class="star" name="nota" type="submit" value="1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                    </svg>
                </button>
            </form>


            <div class="btn-pagamento">
                <form action="" method="post">
                    <!-- <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Métodos de pagamento
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Pix</a></li>
                            <li><a class="dropdown-item" href="#">Crédito</a></li>
                            <li><a class="dropdown-item" href="#">Débito</a></li>
                        </ul>
                    </div> -->
                    <button type="button" class="btn btn-primary" onclick="pop()">Métodos de pagamento</button>
                    <div id="popover">
                        <h3>Aceitamos:</h3>
                        <div>Pix</div>
                        <div>Cartão de crédito</div>
                        <div>Cartão de débito</div>
                        <div>Boleto</div>

                        <button class="btn btn-primary" onclick="pop()">Fechar</button>
                    </div>

                    <button type="button" class="btn btn-secondary">Contratar</button>
                </form>
            </div>


        </section>

    </main>


    <!-- ------------------comentarios------------------ -->
    <section class="comentarios">

        <div>
            <h3>Comentários</h3>
        </div>

        <div class="comentario" id="comen">
            <?php

            if ($comentado->rowCount() > 0) {
                foreach ($comentado as $row) {

            ?>
                    
                    <div class="div-com">
                        <div class="perfil-comentario">
                            <h3><b>Anônimo</b></h3>
                        </div>

                        <div class="texto-comentario">
                            <p><?php echo $row['comentario'] ?></p>
                        </div>
                    </div>
                    <hr>
            <?php
                }
            } else {
                echo "Nenhum comentário";
            }
            ?>
        </div>

        <form action="comentario.php" method="post">


            <div>
                <input type="hidden" name="id_item" value="<?php echo $id ?>">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="comentario"></textarea>
                    <label for="floatingTextarea">Comentário</label>
                </div>

                <button type="submit" class="btn btn-danger mt-3">Postar comentario</button>
            </div>
        </form>

    </section>




</body>
<script>

    
function pop(){
        let popover = document.getElementById("popover")
        popover.classList.toggle("popActive")
    }

    const estrelas = document.getElementsByClassName("star")

    var userNota = "<?php echo $avaliacao ?>"

    var media_notas = String(<?php echo $media_nota['media_inteira']; ?>);

    if (userNota != "" && userNota != null) {
        media_notas = String(userNota)

        switch (media_notas) {
            default:
                break;

            case "1":
                estrelas[4].classList.add("notaUser")
                break;

            case "2":
                estrelas[3].classList.add("notaUser")
                break;

            case "3":
                estrelas[2].classList.add("notaUser")
                break;

            case "4":
                estrelas[1].classList.add("notaUser")
                break;

            case "5":
                estrelas[0].classList.add("notaUser")
                break;
        }
    } else {


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
    }

    
</script>
</html>
