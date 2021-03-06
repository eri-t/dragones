<?php
require_once 'autoload.php';

$auth = new Authentication();
if (isset($_SESSION["id"])) {
  header("Location: abm.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:ital@1&family=Reggae+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <title>Dragones</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Dragones</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="abm.php">ABM</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Iniciar Sesión</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="container-fluid" id="login">

    <?php
    // para mostrar el mensaje de "cerrar sesión":
    if (isset($_SESSION['success'])) {
      $success = $_SESSION['success'];
      unset($_SESSION['success']);
    ?>
      <div class="alert alert-success">
        <?= $success; ?>
      </div>
    <?php
    }
    ?>

    <div id="estado" class="alert d-none"><span id="countdown"></span></div>
    <div class="row pt-3 justify-content-center">
      <div class="card loginCard">
        <h2 class="card-header">Iniciar Sesión</h2>
        <div class="card-body">
          <form action="#" method="post" id="formLogin">
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="form-group">
              <label for="password">Contraseña</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="d-flex align-items-center justify-content-center">
              <button type="submit" class="btn mt-3" id="iniciarSesion">Iniciar Sesión</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div id="respuesta"></div>
  </section>
  <div class="separador"></div>
  <footer class="container-fluid">
    <div class="text-center">
      <img src="img/dragon_footer.png" alt="dragon chino">
      <p>© ERICA TORRICO & FLORENCIA MELLONE</p>
      <p>Parcial 1 | Programación 3 | Clientes Web Mobile</p>
      <p>Primera Escuela de Arte Multimedial Da Vinci</p>
    </div>
  </footer>

  <script src="js/login.js"></script>
</body>

</html>