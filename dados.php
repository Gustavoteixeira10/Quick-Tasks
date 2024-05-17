<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>Document</title>
</head>

<body>
  <?php
  //dados de conexao
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $database = "bdescola";

  //Conectar ao banco de dados
  try {
    $conn = new mysqli($hostname, $username, $password, $database);
  } catch (Exception $e) {
    die("Erro ao conectar:" . $e->getMessage());
  }


  //Criar o comando
  $sql = 'SELECT * FROM aluno';

  //executar o comando
  $resultado = $conn->query($sql);

  foreach ($resultado as $linha) {
  }

  ?>

  <div class="container">

    <div class="border p-3">


      <h1 class="text-center">Cadastro de Aluno</h1>
      <a href="index.php" class="btn btn-success">Inicio</a>
      <table class=" table table-success table-striped-columns table-bordered">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col" class="text-center" colspan="2">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php

          foreach ($resultado as $linha) {

          ?>
            <tr>
              <th scope="row"><?php echo $linha['id']; ?></th>
              <td><?= $linha['nome'] ?></td>
              <td><?= $linha['email'] ?></td>
              <td> <a href="atualiza.php?id=<?= $linha['id'] ?>" class="btn btn-warning padding"><i class="bi bi-pencil-square"></i></a> </td>
              <td><a href="delete.php?id=<?= $linha['id'] ?>" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
            </tr>

          <?php
          }
          unset($_POST, $resultado, $resultadoInsert);
          $conn->close();
          ?>

        </tbody>
      </table>
    </div>
  </div>
</body>

</html>
