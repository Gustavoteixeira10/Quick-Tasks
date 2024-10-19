<?php
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Quicktasks = new Quicktasks();

if (!isset($_SESSION)) {
    session_start();
}

$id_perfil = $_SESSION['id'];

$usuario = $Quicktasks->select_perfil($id_perfil);


$usuario = $usuario->fetch(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="../resources/css/profissional.css?v=<?= time() ?>">
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

    <div>
        <h2>Criar uma nova conta</h2>
        <h3>Dados profissionais </h3>
    </div>

    <section>
        <form method="post" action="../controller/insert.profissional.php" enctype="multipart/form-data">
            <input type="text" hidden name="id_perfil" value="<?php echo $id_perfil ?>">
            <div id="Grid1">
                <h4>NOME</h4>
                <input type="text" value="<?=$usuario['nome']?>" id="nome" name="nome" required>
                <h4>EMAIL</h4>
                <input type="email" value="<?=$usuario['email']?>" id="email" name="email" required>
                <h4>SENHA</h4>
                <input type="password" value="<?=$usuario['senha']?>" id="senha" name="senha" required>
                <h4>DATA DE NASCIMENTO</h4>
                <input type="text" id="data" value="<?=$usuario['data_nascimento']?>" name="data" required>
            </div>

            <div id="Grid2">
                <h4>QUAL SUA ÁREA</h4>
                <input type="text" id="area" name="area" required>
                <h4>SUA LOCALIZAÇÃO</h4>
                <input type="text" id="loc" name="loc" required>
                <h4>FAIXA DE PREÇO</h4>
                <input type="text" id="preco" name="preco" required>
            </div>

            <div class="imagem">
                <input type="file" name="fotos" id="fotos" accept="image/*">
            </div>

            <input type="submit" value="Cadastrar">
        </form>

    </section>


    <script defer src="../resources/js/script.js"></script>

</body>

</html>
