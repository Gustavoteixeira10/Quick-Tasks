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
    <h1 class="text-center"> Cadastro de Aluno</h1>

    <form action="insert.php" method="post">
        <div class="container">

            <div class="row">

                <div class="col-md-8">
                    <label for="exampleInputText1" class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" id="exampleInputText1">
                </div>


                <div class="col-md-4">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Digite o email aqui.</div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="dados.php" class="btn btn-primary">Ver dados</a>
        </div>

    </form>

</body>

</html>
