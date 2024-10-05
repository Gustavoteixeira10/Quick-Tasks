<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QuickTasks</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css?v=<?= time() ?>">
</head>
<?php
require('conexao.php');

if (!isset($_SESSION)) {
  session_start();
}

if (!empty($_SESSION['id'])) {
  $id_user = $_SESSION['id'];

  try {
    $sql = "SELECT * FROM perfil WHERE id = $id_user";
    // Prepara a declaração SQL
    $stmt = $pdo->prepare($sql);

    // Executa a declaração SQL com os parâmetros bind
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    //echo "Login não efetuado";
  }

  $busca = "";
}
?>

<body>

  <header>

    <h1>QuickTasks</h1>

    <form action="busca.php" method="GET" id="busca">
      <input type="text" name="busca" id="txt-busca">
      <input type="submit" value="Buscar" id="btn-busca">
    </form>
    <?php

    if (empty($_SESSION['id'])) {
      echo "<h2><a href='logar.php'>LOGIN</a></h2>";
    }

    if (empty($_SESSION['id'])) {
      echo "<h2><a href='cadastrese.php'>CADASTRE-SE</a></h2>";
    }




    if (!empty($_SESSION['id'])) {
      echo "<h2><a href='profissional.php'>SOU PROFISSIONAL</a></h2>";
    }


    ?>

    <h2><a href="contato.php">CONTATO</a></h2>



    <?php if (!empty($_SESSION['id'])) { ?>
      <div id="perfil">
        <div>
          <img src="<?php if (isset($usuario)) {
                      echo $usuario['foto_perfil'];
                    } else {
                      echo 'usuario.jpg';
                    }
                    ?>" alt="">
        </div>

        <ul id="dropdown">
          <li><a href="myservices.php"> Meus serviços </a></li>
          <li><a href="servicosContratados.php"> Contratados </a></li>
          <li><a href="perfil.php"> Editar Perfil </a></li>
          <li><a href="paginaFavoritos.php"> Favoritos </a></li>
          <li class="btn-sair"><a href="logout.php"> Sair </a></li>
        </ul>
      </div>
    <?php } ?>



  </header>


  <!-- MAIN -->


  <main id="conteudo">

    <!-- CARDS -->
    <a href="busca.php?busca=&categoria=" class="banner">
      <div class="float">
        Serviços 24H
      </div>
    </a>

    <a href="busca.php?busca=&categoria=eletrica" class="card eletrica" id="eletrica">
      <p>Elétrica</p>
      <span class="botao-card">Clique Aqui</span>
      <div></div>
    </a>


    <a href="busca.php?busca=&categoria=hidraulica" class="card hidraulica">
      <p>Hidráulica</p>
      <span class="botao-card">Clique Aqui</span>
      <div></div>
    </a>


    <a href="busca.php?busca=&categoria=geral" class="card geral">
      <p>Geral</p>
      <span class="botao-card">Clique Aqui</span>
      <div></div>
    </a>

    <a href="busca.php?busca=&categoria=pintor" class="card pintor">
      <p>Pintor</p>
      <span class="botao-card">Clique Aqui</span>
      <div></div>
    </a>

    <a href="busca.php?busca=&categoria=carpinteiro" class="card carpinteiro">
      <p>Carpinteiro</p>
      <span class="botao-card">Clique Aqui</span>
      <div></div>
    </a>

    <a href="busca.php?busca=&categoria=instalacoes" class="card instalacoes">
      <p>Instalações</p>
      <span class="botao-card">Clique Aqui</span>
      <div></div>
    </a>

    <a href="busca.php?busca=&categoria=reformas" class="card reformas">
      <p>Pequenas Reformas</p>
      <span class="botao-card">Clique Aqui</span>
      <div></div>
    </a>

    <a href="busca.php?busca=&categoria=moveis" class="card moveis">
      <p>Montagem de móveis</p>
      <span class="botao-card">Clique Aqui</span>
      <div></div>
    </a>

    <a href="busca.php?busca=&categoria=serralheiro" class="card serralheiro">
      <p>Serralheiro</p>
      <span class="botao-card">Clique Aqui</span>
      <div></div>
    </a>




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





</body>
<script>
</script>

</html>
