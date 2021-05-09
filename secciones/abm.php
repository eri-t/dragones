<?php
/*
session_start();
if(!isset($_SESSION["id"])) {
    header('Location: login.php');
    exit;
}
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:ital@1&family=Reggae+One&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <script src="../js/jquery-1.11.3.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>

  <title>Dragones</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Dragones</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">ABM</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../login.php">Iniciar Sesión</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="container-fluid" id="tablaAbm">
    <button id="agregarDragon" type="button" >Agregar Dragón</button>
    <div class="container-fluid">
      <div class="row justify-content-center pb-3">
        <table class="table tabla">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Nombre</th>
              <th scope="col">Categoría</th>
              <th scope="col">Descripción</th>
              <th scope="col">Imagen</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>

          <tbody id="respuesta"></tbody>            
        </table>
      </div>
    </div>
  </section>

  <div class="separador"></div>

  <footer class="container-fluid">
    <div class="text-center"> 
      <img src="../img/dragon_footer.png" alt="dragon chino">
      <p>© ERICA TORRICO & FLORENCIA MELLONE</p>
      <p>Parcial 1 | Programación 3 | Clientes Web Mobile</p>
      <p>Primera Escuela de Arte Multimedial Da Vinci</p>
    </div>
  </footer>

  <script src="../js/listar-todos.js"></script>
  <script src="../js/eliminar.js"></script>
</body>
</html>