<?php

require('conexao.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['id']) && isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
}


$busca = $_GET['busca'];
if(isset($_GET['categoria'])){
    $categoria = $_GET['categoria'];
}



//$sql2 = "SELECT * FROM `profissional` WHERE `area` LIKE '$categoria' AND `faixa_preco` LIKE 'R$$faixa_preco1-R$$faixa_preco2'";
$sql = "SELECT * FROM profissional WHERE nome LIKE '%$busca%' ORDER BY `nome` ASC";


$stmt = $pdo->prepare($sql);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
$numResultados = $stmt->rowCount();




if (isset($_GET['categoria'])){
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
                <input type="text" class="form-control" name="categoria">
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
                <input type="text" class="form-control" disabled>
            </div>

        </div>
        <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>

    </div>

    <div id="main">
        <button class="openbtn" onclick="openNav()">☰</button>
    </div>


    <main id="conteudo">
        <?php


        if (!empty($stmt)) {
            foreach ($resultado as $row) { ?>

                <a class="card" href="servico.php?servico=<?php echo $row['id'] ?>">
                    <p><?php echo $row['nome'] ?></p>
                    <span class="botao-card">Clique Aqui</span>
                    <div></div>
                </a>

        <?php
            }
        } else {
            echo "Nenhum nome encontrado para a área pesquisada.";
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
