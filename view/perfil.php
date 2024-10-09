<?php
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Quicktasks = new Quicktasks();

if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['id'])) {
  echo "Você não está logado.<p><a href='../index.php'>Logar</a></p>";
}

$id_user = $_SESSION['id'];


$stmt = $Quicktasks->select_perfil($id_user);

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickTasks |perfil</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../resources/css/perfil.css">
</head>

<body>

  <header>
    <h1><a href="../index.php">QuickTasks</a></h1>

  </header>





  <form method="POST" action="../controller/alterperfil.php" enctype="multipart/form-data">

    <div class="personal-image">
      <label>
        <input type="file" name="foto" id="foto">
        <figure class="personal-figure">
          <img src="<?php if (isset($usuario) && !empty($usuario['foto_perfil'])) {
                      echo "../".$usuario['foto_perfil'];
                    } else {
                      echo '../resources/images/usuario.jpg';
                    }
                    ?>" class="personal-avatar" alt="avatar">
          <figcaption class="personal-figcaption">
            <img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
          </figcaption>
        </figure>
      </label>
    </div>

    <div id="Grid1">
      <div>
        <h4>EMAIL</h4>
        <input type="email" id="email" name="email" value="<?= $usuario['email'] ?>" required>

        <h4> NUMERO DE TELEFONE</h4>
        <input type="number" id="telefone" name="telefone" value="<?= $usuario['telefone'] ?>" required>
      </div>


      <div>
        <h4>NOME DE USUARIO</h4>
        <input type="text" id="nome" name="nome" value="<?= $usuario['nome'] ?>" required>

        <h4>DATA DE NASCIMENTO</h4>
        <input type="text" id="data" name="data" value="<?= $usuario['data_nascimento'] ?>" required>
      </div>
    </div>

    <div class="botoes">
      <a href="../controller/deletarConta.php" class="deletar">Deletar conta</a>
      <input type="submit" value="Salvar alterações">
    </div>
  </form>

  <!-- Botao dark mode -->

  <div>
    <input type="checkbox" class="checkbox" id="chk" />
    <label class="label" for="chk">
      <i class="fas fa-moon"></i>
      <i class="fas fa-sun"></i>
      <div class="ball"></div>
    </label>
  </div>
  <script defer src="../resources/js/script.js"></script>
  <script src="https://kit.fontawesome.com/998c60ef77.js" crossorigin="anonymous"></script>




</body>

</html>