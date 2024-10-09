<?php
include '../model/Conexao.class.php';
include '../model/Manager.class.php';
$Quicktasks = new Quicktasks();

if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickTasks | Contato</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/abcab2c46f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../resources/css/contato.css">
</head>

<body>

    <header>
        <h1>
            <a href="../index.php">QuickTasks</a>
        </h1>
    </header>

    <main>

        <div class="sobre">
            <div>
                <h2>Sobre o Quick Tasks</h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iste suscipit eum id nihil mollitia sint culpa, error ex incidunt repellendus doloribus aspernatur officia voluptatibus hic quasi at iure perspiciatis doloremque!</p>
            </div>

            <div class="objetivo">
                <h2>Objetivo</h2>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. aspernatur officia voluptatibus hic quasi at iure perspiciatis doloremque!</p>
            </div>
        </div>


        <div class="contato">
            <div>
                <h2>Contato</h2>
            </div>

            <section>
                <div class="email">
                    <p class="txt-email">E-mail</p>
                    <a href="mailto:quicktaskscontato@gmail.com" target="_blank">
                        <i class="fa-solid fa-envelope"></i>
                    </a>

                </div>

                <div class="redes">
                    <p class="txt-email">Instagram</p>
                    <a href="https://www.instagram.com/quick._tasks/" target="_blank">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
            </section>
        </div>



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
  <script defer src="../resources/js/script.js"></script>
  <script src="https://kit.fontawesome.com/998c60ef77.js" crossorigin="anonymous"></script>


</body>

</html>