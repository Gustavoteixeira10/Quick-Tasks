<?php
    include("conexao.php");
    $id = $_GET['servico'];
    //Criar o comando
    $sql = "SELECT * FROM profissional WHERE id = $id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    $numResultados = $stmt->rowCount();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickTasks | Cadastre-se</title>
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
        </section>

    </main>

</body>    
