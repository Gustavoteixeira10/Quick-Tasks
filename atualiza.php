<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Primeiro Projeto</title>
    <style type="text/css">
        body {
            margin: 20px;
        }
    </style>
</head>

<body>
        <?php
            $resultadoSelect = 0; 
            $resultadoUpdate = 0;
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

    if(isset($_GET['id'])){
        //Criar o comando
        $sql = "SELECT * FROM aluno WHERE id= {$_GET['id']}";

        //executar o comando
         $resultadoSelect = $conn->query($sql) ;
    }
   


        ?>

    <h1 class="text-center"> Cadastro de Aluno</h1>
    <?php foreach ($resultadoSelect as $r) : ?>
    <form action="insert.php" method="post">
        <div class="container">

            <div class="row">

                <div class="col-md-4">
                    <label for="exampleInputText1" class="form-label">ID</label>
                    <input type="text" name="id" class="form-control" id="exampleInputText1" value = "<?= $r['id']?>"disabled>
                </div>

            </div>

            <div class="row">

                <div class="col-md-8">
                    <label for="exampleInputText1" class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" id="exampleInputText1" value = "<?= $r['nome']?>">
                </div>


                <div class="col-md-4">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value = "<?= $r['email']?>">
                    <div id="emailHelp" class="form-text">Digite o email aqui.</div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="dados.php" class="btn btn-primary">Ver dados</a>
        </div>

    </form>
    <?php endforeach; ?>
</body>

</html>
