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



$comentarios = "SELECT * FROM comentarios WHERE secao = $id";
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
    <link rel="stylesheet" href="css/logar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="css/servico.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
            <img src="<?= $item['fotos']?>" class="rounded" alt="..."
            onerror="if (this.src != 'images/default_image.png') this.src = 'images/default_image.png'">
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

                <button class="star" name="nota" type="<?= (isset($_SESSION['id'])) == true ? "submit" : "button" ?>" value="5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                    </svg>
                </button>

                <button class="star" name="nota" type="<?= (isset($_SESSION['id'])) == true ? "submit" : "button" ?>" value="4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                    </svg>
                </button>

                <button class="star" name="nota" type="<?= (isset($_SESSION['id'])) == true ? "submit" : "button" ?>" value="3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                    </svg>
                </button>

                <button class="star" name="nota" type="<?= (isset($_SESSION['id'])) == true ? "submit" : "button" ?>" value="2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                    </svg>
                </button>

                <button class="star" name="nota" type="<?= (isset($_SESSION['id'])) == true ? "submit" : "button" ?>" value="1">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.9 33.8-2.3s14.9-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z" />
                    </svg>
                </button>
            </form>


            <div class="btn-pagamento">
                <form action="" method="post">
                    <button type="button" class="btn btn-primary" onclick="pop()">Métodos de pagamento</button>
                    <div id="popover">
                        <h3>Aceitamos:</h3>
                        <div>Pix</div>
                        <div>Cartão de crédito</div>
                        <div>Cartão de débito</div>
                        <div>Boleto</div>

                        <button class="btn btn-primary" onclick="pop()">Fechar</button>
                    </div>

                    <a href="contratar.php?servico=<?= $id ?>" type="button" class="btn btn-secondary">Contratar</a>
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
                            <p id="<?php echo "coment-" . $row['id'] ?>"><?php echo $row['comentario'] ?></p>
                            <input type="text" class="edit-coment" id="<?php echo "txt-" . $row['id'] ?>" value="<?php echo $row['comentario'] ?>"
                                onchange="editComent('<?php echo $row['id'] ?>')" hidden>
                        </div>

                        <div class="botoes-comentario">
                            <?php
                            if (isset($id_user) && $id_user == $row['id_comentador']) {
                            ?>

                                <!-- Muda comentário -->
                                <form action="edit-coment.php" method="POST">
                                    <input type="text" hidden value="<?php echo $row['id'] ?>" name="id_comentario">
                                    <input type="text" hidden value="<?php echo $_GET['servico'] ?>" name="id_item">

                                    <button type="button" class="btn btn-primary delete-btn" onclick="mudaComentario('<?php echo $row['id'] ?>')">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1 0 32c0 8.8 7.2 16 16 16l32 0zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z" />
                                        </svg>
                                    </button>
                                </form>


                                <!-- Delete comentario -->
                                <form action="delete-coment.php" method="POST">
                                    <input type="text" hidden value="<?php echo $row['id'] ?>" name="id_comentario">
                                    <input type="text" hidden value="<?php echo $_GET['servico'] ?>" name="id_item">

                                    <button type="submit" class="btn btn-danger delete-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                        </svg>
                                    </button>


                                <?php
                            }
                                ?>
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
            <input type="text" hidden name="comentador" value="<?php if (isset($id_user)) echo $id_user ?>">

            <?php
            if (isset($id_user)) {
            ?>
                <div>
                    <input type="hidden" name="id_item" value="<?php echo $id ?>">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" name="comentario"></textarea>
                        <label for="floatingTextarea">Comentário</label>
                    </div>

                    <button type="submit" class="btn btn-danger mt-3">Postar comentario</button>
                </div>
            <?php
            }

            ?>
        </form>

    </section>


</body>
<script>
    function pop() {
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

    function mudaComentario(e) {
        let idComent = document.getElementById(`coment-${e}`)
        let inputTxt = document.getElementById(`txt-${e}`)


        if (inputTxt.hidden == true) {
            inputTxt.hidden = false
            idComent.hidden = true
        } else {
            inputTxt.hidden = true
            idComent.hidden = false
        }
        
        console.log(inputTxt.value)
        console.log(idComent.innerHTML)
        idComent.innerHTML = inputTxt.value
    }



    //Ajax
    function editComent(id) {
        let editP = document.getElementById(`txt-${id}`)
        let pagina = "<?php echo $_GET['servico']; ?>"
        // console.log("id do comentário:" + id)
        // console.log("id da pagina:" + pagina)
        // console.log("Novo comentario:" + editP.value)
        $.ajax({


            url: 'edit-coment.php', // Mesma página
            type: 'POST',
            data: {
                id_comentario: id,
                id_item: pagina,
                novo_comentario: editP.value,
                ajax: 1
            },
            success: function(response) {
                $(`#${id}`).html(response);
                console.log('sucesso')
            }
        });
    }
</script>

</html>
