<?php
require './../autoload.php';

$validator = new Validator($_POST, [
    // Aplicamos las reglas de validación definidas en la clase que queremos aplicar a cada clave del
    // array.
    'nombre'        => ['required', 'min:3'],
    'categoria_id'  => ['required', 'numeric'],

]);

if(!$validator->passes()) {
    header('Location: ./../crear.php');
    exit;
}

// Captura de datos.
$nombre             = $_POST['nombre'];
$categoria_id       = $_POST['categoria_id'];
$descripcion        = $_POST['descripcion'];

$dragon = new Dragon();
$exito = $dragon->crear([
    'nombre' => $nombre,
    'categoria_id' => $categoria_id,
    'descripcion' => $descripcion,
]);

if($exito) {
    header('Location: ./../index.php');
} else {
    header('Location: ./../crear.php');
}
