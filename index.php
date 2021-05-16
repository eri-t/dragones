<?php
require_once 'autoload.php';

$auth = new Authentication();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:ital@1&family=Reggae+One&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
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
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="secciones/abm.php">ABM</a>
          </li>
            <?php
            if(!$auth->isAuthenticated()){
            ?>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Iniciar Sesión</a>
          </li>
          <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#modalRegistro">Registrarse</a>
            </li>
            <?php
            }
            else{
            ?>
            <li class="nav-item">
                <a class="nav-link" href="acciones/logout.php">Cerrar Sesión</a>
            </li>
            <?php
            }
            ?>
            
        </ul>
      </div>
    </div>
  </nav>
  <header>
    <h1>Dragones</h1>
    <p>Sumérgete en este fantástico universo</p>
  </header>

  <main>

      <div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Registro</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div id="estado" class="alert d-none"></div>
                      <form id="formRegistro" method="post">
                          <div class="form-group">
                              <label for="usuario">Usuario</label>
                              <input type="text" class="form-control" id="usuario" placeholder="Usuario">
                          </div>
                          <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="ejemplo@mail.com">
                          </div>
                          <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" class="form-control" id="password" placeholder="Password">
                          </div>
                          <div class="d-flex justify-content-center">
                          <button type="submit" class="btn btn-primary" id="registro">Registrarse</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    <div class="separador"></div>
    <section id="dragones">

      <button id="btnTraerTodos" type="button">Ver todos los dragones</button>

      <!-- Acá vamos a imprimir los productos. -->
      <div class="container-fluid">
        <div id="respuesta" class="row justify-content-center pb-3"></div>
      </div>

    </section>
    <div class="separador"></div>
    <section id="cateDragones">
      <button id="btnTraerCategorias" type="button">Ver categorias</button>

      <div class="container-fluid">
          <div id="categoria" class="row justify-content-center pb-3"></div>
      </div>
    </section>
      <div class="separador"></div>
    <script src="js/traer-todos.js"></script>
      <script src="js/registro.js"></script>

  </main>

  <footer class="container-fluid">
    <div class="text-center">
      <img src="img/dragon_footer.png" alt="dragon chino">
      <p>© ERICA TORRICO & FLORENCIA MELLONE</p>
      <p>Parcial 1 | Programación 3 | Clientes Web Mobile</p>
      <p>Primera Escuela de Arte Multimedial Da Vinci</p>
    </div>
  </footer>

</body>

</html>