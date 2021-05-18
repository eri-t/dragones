<?php

require_once '../autoload.php';
/*
$auth = new Authentication();

if(!$auth->isAuthenticated()) {
    header('Location: ../login.php');
    exit;
}
*/

// $titulo = "Nuevo";
// $action = "crear_experiencias";

$categorias = (new Categoria)->traerCategorias();

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=IM+Fell+Double+Pica:ital@1&family=Reggae+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/select2.min.css">
  <link rel="stylesheet" href="../css/select2-bootstrap4.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="../js/jquery-1.11.3.min.js"></script>
  <script src="../js/bootstrap.bundle.min.js"></script>

  <title>Dragones</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php">Dragones</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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

          <?php
          /*  if(!$auth->isAuthenticated()){
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="../login.php">Iniciar Sesión</a>
                </li>
                <?php
            }
            else{
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="../acciones/logout.php">Cerrar Sesión</a>
                </li>
                <?php
            }
            */
          ?>

        </ul>
      </div>
    </div>
  </nav>

  <section class="container-fluid pt-2" id="tablaAbm">
    <div id="mensaje" class="fade show"></div>

    <button id="botonAgregar" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseForm" aria-expanded="false" aria-controls="collapseForm">
      Agregar Dragón
    </button>

    <div class="collapse" id="collapseForm">

      <div class="card card-agregar text-left">
        <h2 class="card-header"><span id="accion"></span> Dragón</h2>
        <div class="card-body">
          <h3 class="h6 pb-1 border-bottom mb-3 col-12">Datos del Dragón</h3>
          <form id="formDragon">
            <input type="hidden" name="pk" id="pk">
            <div class="row">
              <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                <div id="loader" class="position-absolute"></div>

                <figure class="figure">
                  <img src="../img/default.jpg" alt="Dragón genérico" class="img-fluid rounded" id="preview" />
                </figure>

                <div class="form-group mt-0 pt-0">
                  <input accept="image/x-png,image/jpeg" type="file" class="form-control-file" name="poster" id="poster" aria-describedby="fileHelpId">
                  <small id="fileHelpId" class="form-text text-muted">El formato de la imagen debe ser <b>PNG</b> o <b>JPG</b></small>
                </div>
              </div>

              <div class="col-8">
                <div>
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre">
                </div>

                <div>
                  <label for="categoria">Categoría</label>
                  <select name="categoria" id="categoria" class="form-control select2">
                    <option></option>
                    <option value="0">Sin categoría</option>
                    <?php

                    foreach ($categorias as $categoria) :
                    ?>
                      <option value="<?= $categoria->getId(); ?>"><?= $categoria->getNombre(); ?></option>
                    <?php
                    endforeach;

                    ?>
                  </select>
                </div>

                <div class="form-row">
                  <div class="form-group col-12">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control" id="descripcion" cols="30" rows="3"></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-center">
              <button type="submit" class="btn mt-3" id="botonGuardar">Guardar</button>
            </div>
          </form>
        </div>
      </div>

    </div>

    <div class="container-fluid mt-3">
      <div class="row justify-content-center pb-3">
        <h2 class="text-white">Listado de Dragones</h2>
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

  <script src="../js/select2.min.js"></script>
  <script src="../js/abm.js"></script>

  <script>
    $(document).ready(function() {
      $('.select2').select2({
        placeholder: "Seleccione una opción",
        theme: 'bootstrap4',
        width: '100%'
      });
    });
  </script>

</body>

</html>