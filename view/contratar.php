<?php
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Quicktasks = new Quicktasks();


if (!isset($_SESSION)) {
    session_start();
}

if (!empty($_SESSION['id']) && isset($_SESSION['id'])) {
    $id_user = $_SESSION['id'];
}

if(!empty($_GET['servico'])){
    $id = $_GET['servico'];
}

$stmt = $Quicktasks->select_servico_id($id);
$item = $stmt->fetch(PDO::FETCH_ASSOC);
$numResultados = $stmt->rowCount();

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickTasks | Contratar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../resources/css/logar.css?v=<?= time() ?>">
    <link rel="stylesheet" href="../resources/css/contratar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

    <header>
        <h1><a href="../index.php">QuickTasks</a></h1>

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
            <img src="<?= '../'.$item['fotos'] ?>" class="rounded" alt="..."
                onerror="if (this.src != '../resources/images/default_image.png') this.src = '../resources/images/default_image.png'">
        </section>


        <section class="infos-contratar">
            <form action="contratado.php" method="POST">
                <input type="hidden" name="id_servico" value="<?= $id ?>">
                <input type="hidden" name="id_cliente" value="<?= $id_user ?>">


                <h3><b>Nome:</b> <?= $item['nome'] ?></h3>
                <p><b>Área:</b> <?= $item['area'] ?></p>
                <p><b>Preço:</b> <?= $item['faixa_preco'] ?></p>

                <textarea name="" id="txt-area" placeholder="Serviço a ser feito"></textarea>

                <select class="form-select form-select-lg mb-3 select-pix">
                    <option disabled>Selecione uma opção</option>
                    <option value="1">Pix</option>
                    <option value="2">Cartão de crédito</option>
                    <option value="3">Cartão de débito</option>
                </select>

                <button type="submit" class="btn btn-success">Contratar</a>
            </form>
        </section>


        <section>
            <div class="btn-pagamento">

            </div>
        </section>
    </main>

</body>
<script>
    function pop() {
        let popover = document.getElementById("popover")
        popover.classList.toggle("popActive")
    }
</script>

</html>